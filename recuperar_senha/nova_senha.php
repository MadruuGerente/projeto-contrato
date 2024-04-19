<?php
require_once "bd_recupera.php";
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados["entrar"])) {
    if (!empty($dados["senha"]) && !empty($dados["conf"])) {
        session_start();
        $cpf = $_SESSION['cpf_senha'];
        if ($dados["senha"] == $dados["conf"]) {
            // $cpf = $_SESSION['cpf_senha'];
            // $d = $_GET['a'];
            $confirmar = atualizarSenha($cpf, $dados["senha"]);
            if ($confirmar != 0) {
                echo (" ATUALIZADO COM SUCESSO");
                header("Location:..\login/login.php");
            }
        }else{
            header("Location:nova_senha.php?a=0");
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
            text: "Digite a mesma senha nos dois campos!"
            
          });
        </script>');
    } ?>
    <div class="title-container">
        <h1>SergipeTec</h1>
        <h2>Sergipe Parque Tecnológico</h2>
    </div>

    <div class="login-container">
        <h2> NOVA SENHA</h2>
        <form action="#" method="POST">
            <label for="senha">senha</label><br>
            <input type="text" id="senha" name="senha" required><br>
            <label for="conf">Confirmar senha</label><br>
            <input type="text" id="conf" name="conf" required><br><br>
            <!-- <a href="..\sempermissao/sempermissao.php">Não tenho cadastro</a>
    /
        <a href="..\recuperar_senha/recuperar.php">Esqueci a senha</a> -->
            <input type="submit" name="entrar" value="Entrar">
        </form>
    </div>

</body>

</html>