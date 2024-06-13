<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: ..\login/login.php");
    exit();
} elseif ($_SESSION['status'] == "inativo") {
    header("Location: ..\login/login.php?c=0");
    exit();
}
//olá mundo

// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";

// Obter o login do usuário da sessão
$cpf = $_SESSION['cpf'];
$perfil = $_SESSION['perfil'];
// Consultar o banco de dados para obter informações do usuário
$img_perfil = "..\imagens/perfil.png";

try {
    $conexao = new Conexao();
    $conn = $conexao->connect();

    // Consultar informações do usuário usando o campo de login
    $sql = "SELECT * FROM login WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
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
?>

<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/stylemenu.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <script src="scripts/funcoes.js"></script>
    <title>TESTE</title>
</head>

<body class="body">
    <?php if (isset($_GET['e'])) {
        $nome = $_SESSION['nome'];
        echo ('<script type="text/javascript"> entrou("' . $nome . '");</script>');
    }
    if (isset($_GET['i'])) {
        echo ('<script type="text/javascript"> let v = sair();</script>');
    }
    if (isset($_GET['resultado']) && $_GET['resultado'] == "sair") {
        header("Location: fechar.php");
    }
    ?>
    <!-- Conteúdo da Página -->
    <div class="content">
        <h1>Sistema de Gestão</h1>
        <h1>Ainda em Desenvolvimento</h1>
    </div>

    <nav class="nav">

        <!-- <a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
             <img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]"
                alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d"
                src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png"> 
            <noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png'
                    alt='Sergipetec'></noscript>
        </a> -->
        <img src="..\imagens/barra-de-menu3.png" id="toggle-sidebar" class="imagem-menu" alt="teste">
        <img src="..\imagens/logo.png" id="logo.png" class="logo-menu" alt="teste">
        <h3 class="h1_sistema"> SISTEMA DE GESTÃO </h3>
        <img src="<?php echo $img_perfil ?>" id="perfil" class="perfil-menu" alt="teste">
        <!-- <h3 class="nome-perfil">perfil</h3> -->


        <!-- <a href="..\perfil/perfil.php">Meu perfil</a> -->
        <!-- <?php
        if ($usuario['perfil'] == 'Gestor') {
            echo '<a id = "ger" href = "..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
            echo '<a href="..\projetos/antes_projetos.php">Projetos</a>';
        } else if ($usuario['perfil'] == 'funcionario') {
            echo '<a id = "ger" href = "..\atividades/atividades.php">Atividades</a>';
            echo '<a href="..\relatorios/relatorios.php">Relatorios</a>';
        }
        ?> -->
    </nav>
    <!-- <button id="toggle-sidebar">Mostrar Menu</button> -->
    <img src="..\imagens/iconeperfil.png" id="icon.png" class="icon-menu" alt="teste">

    <div class="r" id="sidebar">
        <?php
        if ($perfil == "Gestor") {
            ?>
            <a href="..\relatorios/relatorios.php">Relatórios</a>
            <a href="..\perfil/perfil.php">Perfil</a>
            <!-- <a href="..\atividades/atividades.php">Recebidos</a> -->
            <a href="..\projetos/antes_projetos.php">Projetos</a>
            <a href="menu.php?i=0">sair</a>
            <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a>
            <?php
        }elseif($perfil == "Mega Gestor"){   
            ?>
            <a href="..\relatorios/relatorios.php">Criar contrato</a>
            <a href="..\perfil/perfil.php">Perfil</a>
            <!-- <a href="..\atividades/atividades.php">Atividades</a> -->
            <a href="..\atividades/atividades.php">Recebidos</a>
            <a href="..\projetos/antes_projetos.php">Projetos</a>
            <a href="menu.php?i=0">sair</a>
            <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a>
            <?php
        }
        ?>
        <!-- <a href="..\relatorios/relatorios.php">Relatórios</a> -->
        <!-- <a href="..\perfil/perfil.php">Perfil</a> -->
        <!-- <a href="..\atividades/atividades.php">Atividades</a> -->
        <!-- <a href="..\atividades/atividades.php">Recebidos</a> -->
        <!-- <a href="..\projetos/antes_projetos.php">Projetos</a> -->
        <!-- <a href="menu.php?i=0">sair</a> -->
        <!-- <a href="https://www.instagram.com/rafaelpdesantana/">Contato</a> -->
    </div>

    <div class="content">
        <h1>Bem-vindo ao Meu Site</h1>
        <p>Conteúdo do site aqui.</p>
    </div>
    <script src="scripts/funcoes.js"></script>
</body>

</html>