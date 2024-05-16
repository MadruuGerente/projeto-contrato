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
// Consultar o banco de dados para obter informações do usuário
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
    $id_programa = $_GET['id'];

    $resultado_delete = deletePrograma($id_programa);
    if ($resultado_delete > 0) {

    }
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

    $chave_verificar_tb_contratos = "SELECT * FROM programa WHERE cpf_criador= :cpf_criador";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    // $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":cpf_criador", $cpf_criador);
    $stmt->execute();
    $count = $stmt->rowCount();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($count > 0) {
        echo "<h1>Relatórios:</h1>";
        echo "<p>Total de relatórios encontrados: $count</p>";

        foreach ($dados as $rgt) {
            $id_programa = $rgt['id_programa'];
            echo '<p>';
            echo "<a href='mostrar_relatorio.php?id=$id_programa'> $rgt[nome_programa]</a>||";
            echo "<a href='editar_relatorio.php?id=$id_programa'> Editar </a>||";
            echo "<a href='relatorios.php?id=$id_programa'> Deletar </a> ||";
            echo "<a href='#' class='bt'name='$id_programa'id='tag_enviar'> Enviar </a><br>";
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
        <form action="relatorios.php" method="post">
            <!-- <img src='imagens/logo.png'> -->
            <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
        </form>
    </div>
    <nav class="nav">
        <img src="..\imagens/barra-de-menu3.png" id="toggle-sidebar" class="imagem-menu" alt="teste">
        <img src="..\imagens/logo.png" id="logo.png" class="logo-menu" alt="teste">
        <h2 class="hs"> SISTEMA DE GESTÃO <h2>
                <img src="..\imagens/perfil.png" id="perfil" class="perfil-menu" alt="teste">

    </nav>
    <div class="sidebar" id="sidebar">
        <a href="..\menu/menu.php">Menu</a>
        <a href="..\perfil/perfil.php">Perfil</a>
        <a href="..\atividades/atividades.php">Atividades</a>
        <a href="..\menu/menu.php?i=0">sair</a>
        <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a>
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
<!-- <script src=""></script> -->
</body>
</html>