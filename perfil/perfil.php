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
// echo"<h1>$cpf </h1>";
// Inicializar variável de status
$status = '';
$uploadStatus = '';
$img_perfil ="..\imagens/perfil.png";

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
    if($usuario['tem_img'] == 1){
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/styleperfil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                // echo '<p>Nenhuma foto de perfil disponível.</p>';
            }
            ?>
        </div>
        <h2 class="h">Perfil</h2>
        <img class="img-perfil" id="imd-perfil" src="<?php echo  $img_perfil ?>" alt="teste">
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
            <!-- <form action="perfil.php" method="post" id="statusForm">
            <label for="status">Status:</label><br>
            <textarea id="status" name="status" rows="4" cols="50"><?php echo htmlspecialchars($usuario['status']); ?></textarea><br>
            <input type="submit" value="Atualizar Status" name="status_form">
           <a href="fechar.php">logoff</a>
        </form> -->
        </div>

        <!-- Exibir o status se estiver definido -->
        <!-- <div id="statusDisplay">
        <?php
        if (isset($usuario['status'])) {
            echo '<p>' . nl2br(htmlspecialchars($usuario['status'])) . '</p>';
        } else {
            echo '<p>Nenhum status disponível.</p>';
        }
        ?>
    </div> -->

        <!-- Adicionar campo de foto de perfil -->
        <h3>Foto de Perfil</h3>
        <div id="photoForm">
            <?php echo '<p>' . $uploadStatus . '</p>'; ?>

            <!-- Exibir formulário de foto de perfil -->
            <form action="perfil.php" method="post" id="photoForm" enctype="multipart/form-data">
                <label for="photo">Escolher uma foto:</label><br>
                <input type="file" name="<?php echo "$cpf" ?>" id="photo"><br>
                <input type="button" value="Atualizar Foto de Perfil" id="button_perfil" name="button_perfil">
            </form>
        </div>


    </div>

    <nav class="nav">
        <!--<a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a> -->
        <!-- <a href="perfil.php">Perfil</a>-->
        <a href="..\menu/menu.php">Voltar menu</a>
        <?php
        if ($usuario['perfil'] == 'gestor') {
            echo '<a href="..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
            echo ' <a href="..\projetos/antes_projetos.php">Projetos</a>';
        } else if ($usuario['perfil'] == 'funcionario') {
            echo '<a href="..\relatorios/relatorios.php">Relatórios</a>';
            echo '<a href="..\atividades/atividades.php">Atividades</a>';
        }
        ?>
        <!--<a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> -->
    </nav>


</body>
<script>
    let button_perfil = document.querySelector("#button_perfil");
    button_perfil.addEventListener("click", function () {
        let img_perfil = document.querySelector("#photo");
        let formData = new FormData();

        let cpf = img_perfil.name;
        img_perfil = img_perfil.files[0];
        let tipo = img_perfil.name.split('.').pop().toLowerCase();
        // alert(tipo);
        if (tipo == "jpg" || tipo == "png" ||tipo == "jpeg") {
            formData.append("img_perfil", img_perfil);
            formData.append("cpf_user", cpf);
            // alert(`fsdfsdfsdg ${cpf}`);

       
                // Aqui você pode colocar seu código de AJAX
                $.ajax({
                    url: 'funcoes.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (resposta) {
                        console.log(resposta);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
        } else {
            return "erro";
        }
    });


</script>

</html>