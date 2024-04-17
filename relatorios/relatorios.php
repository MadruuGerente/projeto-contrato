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
if (isset($_SESSION['cpf'])) {

    $con = new Conexao();
    $mysqli = $con->connect();


    $chave_verificar_tb_contratos = "SELECT * FROM programa";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    // $stmt->bindParam(":id_tabela", $id_tabela_total);
// $stmt->bindParam(":ano", $ano);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo "<h1>Relatórios:</h1>";
        echo "<p>Total de relatórios encontrados: $count</p>";
        while ($rgt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id_programa = $rgt['id_programa'];
            echo '<p>';
            echo "<a href='criarel.php?id=$id_programa'> $rgt[nome_programa]</a>||";
            echo "<a href=''> Editar </a>||";
            echo "<a href='relatorios.php?id=$id_programa'> Deletar </a><br>";
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
    <link rel="stylesheet" href="stylerelatorios.css">
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
        <a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
            <!--	<img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]" alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d" src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png">
                <noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png' alt='Sergipetec'></noscript>
            </a>-->
            <h2 class="hs"> SISTEMA DE GESTAO <h2>
                    <a href="https://sergipetec.org.br" <div id="sergipeTec">Sergipe<span
                            style="color: #2ecc71;">Tec</span></div></a>
                    <a href="..\perfil/perfil.php">Perfil</a>
                    <a href="..\menu/menu.php">menu</a>
                    <!-- <a href="..\relatorios/relatorios.php">Relatórios</a>
    <a href="..\projetos/projetos.php">Projetos</a> -->
                    <!-- <?php
                    if ($usuario['perfil'] == 'gestor') {
                        echo '<a href="..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
                        echo '<a href="..\projetos/projetos.php">Projetos</a>';
                    } else if ($usuario['perfil'] == 'funcionario') {
                        echo '<a id = "ger" href = "..\atividades/atividades.php">Atividades</a>';
                    }
                    ?> -->
                    <!-- <a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> 
</nav>

</body>
</html>