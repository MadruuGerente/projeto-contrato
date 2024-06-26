<!-- 
<?php
session_start();
// Adicionar condição para criar relatório
if (isset($_POST['criar_relatorio_form'])) {
    // Redirecionar para a página de criação de relatório
    header("Location: criar_relatorio.php");
    exit();
}

// Adicionar condição para apagar relatório
if (isset($_GET['acao']) && $_GET['acao'] === 'apagar' && isset($_GET['relatorio'])) {
    $relatorioIndex = $_GET['relatorio'];
    // Verificar se o índice do relatório existe na sessão  
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        // Apagar o relatório
        unset($_SESSION['relatorios'][$relatorioIndex]);
        // Reorganizar os índices do array após a exclusão
        // $_SESSION['relatorios'] = array_values($_SESSION['relatorios']);
    }
}
?>
<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}
// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";

// Obter o login do usuário da sessão
$login = $_SESSION['cpf'];
$perfil_ent = $_SESSION['perfil'];
$pagina = "relatorios.php";
$string_input = "";
echo ($perfil_ent) . "2222   ";
if ($perfil_ent == "Gestor") {
    $pagina = "criar_relatorio.php";
    $string_input = "Criar relatório";

} elseif ($perfil_ent == "Mega Gestor") {
    $pagina = "criar_contratos.php";
    $string_input = "Criar contratos";
}

// Consultar o banco de dados para obter informações do usuário
$img_perfil = "..\imagens/perfil.png";
try {
    $conexao = new Conexao();
    $conn = $conexao->connect();

    // Consultar informações do usuário usando o campo de login
    $sql = "SELECT * FROM login WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $login);
    $stmt->execute();

    // Obter os resultados da consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario['tem_img'] == 1) {
        $img_perfil = $usuario['img_perfil'];
    }
    // Verificar se a consulta retornou resultados
    if (!$usuario) {
        echo "DEBUG: Usuário não encontrado no banco de dados.";
        exit();
    }
} catch (Exception $e) {
    echo "DEBUG: Erro de conexão: " . $e->getMessage();
    exit();
} finally {
    // Fechar a conexão com o banco de dados
    $conn = null;
}
?> -->

<?php
require_once "..\bancodedados/bd_conectar.php";
require "insercoes.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $resultado_delete = deletePrograma($id);


    $resultado_delete = deleteContrato($id);
    if ($resultado_delete > 0) {

    }
}
function limitarString($string, $limite)
{
    // Verifica se a string é maior que o limite
    if (strlen($string) > $limite) {
        // Corta a string até o limite desejado
        $string = substr($string, 0, $limite);
        // Adiciona os três pontos
        $string .= '...';
    }
    return $string;
}
$perfil = 0;
if (isset($_SESSION['cpf'])) {
    $perfil = "Mega Gestor";
    $cpf_criador = $_SESSION["cpf"];
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_selecionar_mega = "SELECT * FROM login WHERE perfil=:perfil";
    $stmt_mega = $mysqli->prepare($chave_selecionar_mega);
    $stmt_mega->bindParam(":perfil", $perfil);
    $stmt_mega->execute();

    $chave_verificar_tb_programas = "SELECT * FROM programa WHERE cpf_criador= :cpf_criador";
    $stmt = $mysqli->prepare($chave_verificar_tb_programas);
    // $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":cpf_criador", $cpf_criador);
    $stmt->execute();
    $count = $stmt->rowCount();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($count > 0) {
        echo "<h1>Relatórios:</h1>";
        echo "<p>Total de relatórios encontrados: $count</p>";

        foreach ($dados as $rgt) {
            $limitada = limitarString($rgt['nome_programa'], 15);
            $id_programa = $rgt['id_programa'];
            echo '<p>';
            echo "<a href='mostrar_relatorio.php?id=$id_programa'> $limitada</a>||";
            echo "<a href='editar_relatorio.php?id=$id_programa'> Editar </a>||";
            echo "<a href='relatorios.php?id=$id_programa'> Deletar </a> ||";
            echo "<a href='#' class='bt'name='$id_programa'id='tag_enviar'> Enviar </a><br>";
            echo '</p>';
        }
    } else {
        if ($perfil_ent == "Gestor") {

            echo ("<h2>Nenhum relatório criado</h2>");
        }
    }
    $chave_verificar_tb_contratos = "SELECT * FROM contratos WHERE cpf_criador= :cpf_criador";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    // $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":cpf_criador", $cpf_criador);
    $stmt->execute();
    $count_contratos = $stmt->rowCount();
    $dados_contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($count_contratos > 0) {
        echo "<h1>Contratos:</h1>";
        echo "<p>Total de contratos encontrados: $count_contratos</p>";

        foreach ($dados_contratos as $rgt) {
            $id_contrato = $rgt['id_contrato'];
            echo '<p>';
            echo "<a href='mostrar_relatorio.php?id=$id_contrato'> $rgt[nome_contrato]</a>||";
            echo "<a href='editar_relatorio.php?id=$id_contrato'> Editar </a>||";
            echo "<a href='relatorios.php?id=$id_contrato'> Deletar </a> ";
            // echo "<a href='#' class='bt'name='$id_contrato'id='tag_enviar'> Enviar </a><br>";
            echo '</p>';
        }
    } else {
        echo ("<h2>Nenhum relatório criado</h2>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/stylerelatorios.css">
    <link rel="stylesheet" href="..\menu/pasta_de_estilos/stylemenu.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Relatórios</title>
</head>

<body class="body">
    <!-- Conteúdo da Página -->
    <div class="content">
        <h2>Relatórios</h2>

        <!-- <?php
        // Verificar se há relatórios na variável de sessão
        if (isset($_SESSION['relatorios']) && !empty($_SESSION['relatorios'])) {
            // Exibir lista de relatórios disponíveis com links para mostrar e apagar cada um
            echo '<p>Há relatórios disponíveis. Escolha um abaixo para mostrar ou apagar:</p>';
            foreach ($_SESSION['relatorios'] as $index => $relatorio) {
                echo '<p>';
                echo '<a href="mostrar_relatorio.php?relatorio=' . $index . '">Relatório ' . ($index) . '</a>';
                echo ' | ';
                echo '<a href="relatorios.php?acao=apagar&relatorio=' . $index . '">Apagar</a>';
                echo ' | ';
                echo '<a href="editar_relatorio.php?relatorio=' . $index . '">Editar</a>';
                echo '</p>';
            }
        } else {
            echo '<p>Nenhum relatório disponível.</p>';
        }
        ?> -->

        <!-- Adicionar opção para criar relatório -->
        <h3>Criar Relatório</h3>
        <form action=<?php echo $pagina ?> method="post">
            <!-- <img src='imagens/logo.png'> -->

            <?php

            if ($perfil_ent == "Gestor") {
                ?>
                <input type="submit" value="Criar relatório" name="criar_relatorio_form">
                <?php
            } elseif ($perfil_ent == "Mega Gestor") {
                ?>
                <input type="submit" value="Criar Contratos" name="criar_relatorio_form">
                <?php
            }

            ?>

        </form>
    </div>
    <nav class="nav">
        <img src="..\imagens/barra-de-menu3.png" id="toggle-sidebar" class="imagem-menu" alt="teste">
        <img src="..\imagens/logo.png" id="logo.png" class="logo-menu" alt="teste">
        <h2 class="hs"> SISTEMA DE GESTÃO <h2>
                <img src="<?php echo $img_perfil ?>" id="perfil" class="perfil-menu" alt="teste">


    </nav>
    <div class="r" id="sidebar">
        <?php if ($perfil_ent == "Gestor") {
            ?>
            <a href="..\menu/menu.php">Menu</a>
            <a href="..\perfil/perfil.php">Perfil</a>
            <!-- <a href="..\atividades/atividades.php">Atividades</a> -->
            <a href="..\menu/menu.php?i=0">sair</a>
            <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a>
            <?php
        } elseif ($perfil_ent == "Mega Gestor") {
            ?>
            <a href="..\menu/menu.php">Menu</a>
            <a href="..\perfil/perfil.php">Perfil</a>
            <a href="..\atividades/atividades.php">Recebidos</a>
            <a href="..\menu/menu.php?i=0">sair</a>
            <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a>
            <?php
        } ?>

    </div>
    <div class="modal" id="modal">
        <?php
        while ($rgt_mega = $stmt_mega->fetch(PDO::FETCH_ASSOC)) {
            $nome = $rgt_mega["nome"];
            $id = $rgt_mega["login"];
            // echo " <input type='checkbox' id='interest' name='interest' value='$nome'> $nome";
            ?>
            <input type="checkbox" class="checkboxes" id="<?php echo $id; ?>" name="" value="<?php echo $nome; ?>">
            <label for="<?php echo $id; ?>"> <?php echo $nome; ?> </label><br>
            <?php
        }
        ?>
        <button class="button_modal"> enviar</button>
    </div>



    <script src="scripts/script_enviar.js"></script>
    <?php
    if (isset($_GET['o'])) {
        // Chama a função JavaScript 'entrou' com o parâmetro 'editar'
        echo '
    <script type="text/javascript">
        entrou("editar");
    </script>';
    }

    ?>


    <!-- <script src=""></script> -->
</body>

</html>