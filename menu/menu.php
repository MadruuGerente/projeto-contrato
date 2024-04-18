<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";

// Obter o login do usuário da sessão
$cpf = $_SESSION['cpf'];
// Consultar o banco de dados para obter informações do usuário
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
    <title>TESTE</title>
</head>

<body class="body">
    <?php if (isset($_GET['e'])) {
        echo ('<script type="text/javascript">  
    
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Login feito com sucesso",
            showConfirmButton: false,
            width: 400, // Defina a largura desejada
            
            timer: 1500
          });
        </script>');
    } ?>
    <!-- Conteúdo da Página -->
    <div class="content">
        <h1>Sistema de Gestão</h1>
        <h1>Ainda em Desenvolvimento</h1>
    </div>

    <nav class="nav">

        <a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
            <img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]"
                alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d"
                src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png">
            <noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png'
                    alt='Sergipetec'></noscript>
        </a>
        <a href="..\perfil/perfil.php">Meu perfil</a>

        <?php
        if ($usuario['perfil'] == 'gestor') {
            echo '<a id = "ger" href = "..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
            echo '<a href="..\projetos/antes_projetos.php">Projetos</a>';
        } else if ($usuario['perfil'] == 'funcionario') {
            echo '<a id = "ger" href = "..\atividades/atividades.php">Atividades</a>';
            echo '<a href="..\relatorios/relatorios.php">Relatorios</a>';
        }
        ?>
    </nav>
</body>

</html>