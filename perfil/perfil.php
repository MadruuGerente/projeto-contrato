<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: ..\login/login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";

// Obter o login do usuário da sessão
$cpf = $_SESSION['cpf'];
echo"<h1>$cpf </h1>";
// Inicializar variável de status
$status = '';
$uploadStatus = '';

// Processar o envio do formulário de status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_form'])) {
    // Obter o status do formulário
    $novoStatus = $_POST['status'];

    // Atualizar o status no banco de dados
    try {
        $conexao = new Conexao();
        $conn = $conexao->connect();

        // Atualizar o status do usuário
        $sql = "UPDATE login SET status = :status WHERE cpf = :cpf";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $novoStatus);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        $status = 'Status atualizado com sucesso.';
    } catch (Exception $e) {
        echo "DEBUG: Erro de conexão: " . $e->getMessage();
        exit();
    } finally {
        // Fechar a conexão com o banco de dados
        $conn = null;
    }
}

// Processar o envio do formulário de foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_form'])) {
    // Diretório onde as fotos de perfil serão armazenadas
    $photoDir = 'uploads/profile_photos/';

    // Nome único para o arquivo de destino
    $photoFileName = $login . '_' . time() . '_' . basename($_FILES['photo']['name']);
    $photoPath = $photoDir . $photoFileName;

    // Verificar se o arquivo é uma imagem real
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
        // Tentar mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $uploadStatus = 'Foto de perfil atualizada com sucesso.';
        } else {
            $uploadStatus = 'Erro ao fazer o upload da foto de perfil.';
        }
    } else {
        $uploadStatus = 'O arquivo não é uma imagem válida.';
    }
}

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/styleperfil.css">
    <title>Perfil</title>

</head>
<body class="body">

<!-- Conteúdo da Página -->
<div class="content">
     <!-- Exibir a foto de perfil se estiver definida -->
     <div id="photoDisplay">
        <?php
        if (isset($photoFileName)) {
            echo '<img src="' . htmlspecialchars($photoPath) . '" alt="Foto de Perfil">';
        } else {
            echo '<p>Nenhuma foto de perfil disponível.</p>';
        }
        ?>
    </div>

    <h2 class="h">Perfil</h2>

    <!-- Exibir informações do usuário -->
    <p><strong>Nome:</strong> <?php echo $usuario['nome']; ?></p>
    <p><strong>Login:</strong> <?php echo $usuario['login']; ?></p>
    <p><strong>CPF:</strong> <?php echo $usuario['cpf']; ?></p>
    <p><strong>Perfil:</strong> <?php echo $usuario['perfil']; ?></p>
    <p><strong>Setor:</strong> <?php echo $usuario['setor']; ?></p>
    <!-- Adicionar campo de status -->
    <h3 class="h">Status</h3>
    <div id="statusForm">
        <?php echo '<p>' . $status . '</p>'; ?>

        <!-- Exibir formulário de status -->
        <form action="perfil.php" method="post" id="statusForm">
            <label for="status">Status:</label><br>
            <textarea id="status" name="status" rows="4" cols="50"><?php echo htmlspecialchars($usuario['status']); ?></textarea><br>
            <input type="submit" value="Atualizar Status" name="status_form">
           <a href="fechar.php">logoff</a>
        </form>
    </div>

    <!-- Exibir o status se estiver definido -->
    <div id="statusDisplay">
        <?php
        if (isset($usuario['status'])) {
            echo '<p>' . nl2br(htmlspecialchars($usuario['status'])) . '</p>';
        } else {
            echo '<p>Nenhum status disponível.</p>';
        }
        ?>
    </div>

    <!-- Adicionar campo de foto de perfil -->
    <h3>Foto de Perfil</h3>
    <div id="photoForm">
        <?php echo '<p>' . $uploadStatus . '</p>'; ?>

        <!-- Exibir formulário de foto de perfil -->
        <form action="perfil.php" method="post" id="photoForm" enctype="multipart/form-data">
            <label for="photo">Escolher uma foto:</label><br>
            <input type="file" name="photo" id="photo"><br>
            <input type="submit" value="Atualizar Foto de Perfil" name="photo_form">
        </form>
    </div>

   
</div>

<nav class="nav">

 
    <!--<a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a> -->
    <!-- <a href="perfil.php">Perfil</a>-->
    <a href="..\menu/menu.php">Voltar menu</a>
    <?php
    if($usuario['perfil'] == 'gestor'){
        echo '<a href="..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
        echo' <a href="..\projetos/antes_projetos.php">Projetos</a>';
    }else if($usuario['perfil'] == 'funcionario'){
        echo'<a href="..\relatorios/relatorios.php">Relatórios</a>';
        echo'<a href="..\atividades/atividades.php">Atividades</a>';
    }
    ?>
    <!--<a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> -->
</nav>
</nav>

</body>
</html>
