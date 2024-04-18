<?php
require_once "bd_Login.php";
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados["entrar"])) {
    if (!empty($dados["login"]) && !empty($dados["senha"])) {
        if ($dados["login"] == "adm" && $dados["senha"] == "adm1234") {
            header("Location:..\_telaadm/telaadm.php");
        } else {
            $slog = new login();
            $confirmar = $slog->login($dados['login'], $dados['senha']);
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <title>SergipeTec - Login</title>
</head>

<body class="body">
    <!-- <button onclick="teste()">ddd</button> -->

    <div class="title-container">
        <h1>SergipeTec</h1>
        <h2>Sergipe Parque Tecnológico</h2>
    </div>

    <?php if (isset($_GET['a'])) {
        echo ('<script type="text/javascript">  
    
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Credenciais inválidas!",
            
          });
        </script>');
    }elseif(isset($_GET['e'])){
        echo ('<script type="text/javascript">  
    
        Swal.fire({
            icon: "success",
            
            text: "Atualizado com sucesso!",
            
          });
        </script>');
    } ?>

    <div class="login-container">
        <h2>Login</h2>
        <form action="#" method="POST" onsubmit="return teste()">
            <label for="login">Login:</label><br>
            <input type="text" id="login" name="login" required><br>
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br><br>
            <a href="..\sempermissao/sempermissao.php">Não tenho cadastro</a>
            <a href="..\recuperar_senha/recuperar.php">Esqueci a senha</a>

            <input type="submit" name="entrar" id="entrar" value="Entrar">


        </form>
    </div>

</body>
<script>
    function erro() {

        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500
        });
    }


</script>

</html>