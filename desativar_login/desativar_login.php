<?php
include "bd_conectar.php";
// Verificar se os parâmetros 'login' e 'cpf' foram enviados via POST
if (isset($_POST['login']) && isset($_POST['cpf'])) {
    // Obter e sanitizar os valores dos parâmetros 'login' e 'cpf'
    $login = $mysqli->real_escape_string($_POST['login']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);

    // Consulta SQL usando instruções preparadas
    $sql = "SELECT * FROM login WHERE login = ? AND cpf = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $login, $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        // Usuário encontrado, agora você pode executar o DELETE se desejar
        $status = "inativo";
        $updateSql = "UPDATE login SET status = ? WHERE login = ? AND cpf = ?";
        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param("sss", $status, $login, $cpf);
        $updateStmt->execute();

        header("Location: ..\login/login.php?b=0");
    } else {
        echo "Location: desativar_login.php?a=0";
    }

    // Fechar a instrução preparada
    $stmt->close();
} else {
    echo "Parâmetros 'login' e 'cpf' não fornecidos.";
}

// Fechar a conexão
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="PT-br">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="pasta_de_estilos/styleapagarlogin.css">
        <title>SergipeTec - Login</title>

    </head>

<body class="body">

    <div class="title-container">
        <h1>SergipeTec</h1>
        <h2>Sergipe Parque Tecnológico</h2>
    </div>

    <div class="login-container">
        <h2 class="cancelar">Apagar login</h2>
        <form action="#" method="POST">

            <div>
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" required>
            </div>

            <div>
                <label for="senha">cpf:</label>
                <input type="text" id="cpf" name="cpf" required><br><br>
            </div>

            <div>
                <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                <a class="cancelar" href="..\_telaadm/telaadm.php">Cancelar</a>
                <input class="button" type="submit" name="entrar" value="entrar">
            </div>

        </form>

    </div>

</body>

</html>


</body>

</html>