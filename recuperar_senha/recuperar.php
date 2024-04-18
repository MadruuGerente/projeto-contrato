<?php
require_once "bd_recupera.php";
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados["entrar"])) {
    if (!empty($dados["login"]) && !empty($dados["cpf"])) {
        $certo = verifica($dados["login"], $dados["cpf"]);
        if ($certo != 0) {
            header("Location:nova_senha.php?cpf=$dados[cpf]&&a=0");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\login/pasta_de_estilos/stylelogin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <title>SergipeTec - Login</title>
</head>

<body class="body">

<?php if (isset($_GET['a'])) {
        echo ('<script type="text/javascript">  
    
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Login ou cpf não encontrado!"
            
          });
        </script>');
    } ?>

    <div class="title-container">
        <h1>SergipeTec</h1>
        <h2>Sergipe Parque Tecnológico</h2>
    </div>

    <div class="login-container">
        <h2>Recuperar</h2>
        <form action="#" method="POST">
            <label for="login">Login:</label><br>
            <input type="text" id="login" name="login" required><br>
            <label for="cpf">CPF:</label><br>
            <input type="password" id="cpf" name="cpf" required><br><br>
            <!-- <a href="..\sempermissao/sempermissao.php">Não tenho cadastro</a>
        <a href="..\recuperar_senha/recuperar.php">Esqueci a senha</a> -->
            <input type="submit" name="entrar" value="Entrar">
        </form>
    </div>

</body>

</html>