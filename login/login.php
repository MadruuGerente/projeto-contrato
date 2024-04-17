<?php 
$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
if(!empty($dados["entrar"])){
   if(!empty($dados["login"]) && !empty($dados["senha"])){
    if($dados["login"] == "adm" && $dados["senha"] == "adm1234"){
        header("Location:..\_telaadm/telaadm.php");
    }else{
        require_once "bd_Login.php";
        $slog = new login();
        $slog->login($dados['login'],$dados['senha']);
    }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/stylelogin.css">
    <title>SergipeTec - Login</title>
</head>
<body class = "body">

<div class="title-container">
    <h1>SergipeTec</h1>
    <h2>Sergipe Parque Tecnológico</h2>
</div>

<div class="login-container">
    <h2>Login</h2>
    <form action="#" method="POST">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        <a href="..\sempermissao/sempermissao.php">Não tenho cadastro</a>
        <input type="submit" name="entrar" value="Entrar">
    </form>
</div>

</body>
</html>
