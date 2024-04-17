
<?php 

$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
if(!empty($dados["entrar"])){
   if(!empty($dados["login"]) && !empty($dados["senha"]) && !empty ($dados["cpf"])){
    require_once "bd_novologin.php";
    $slog = new Novologin();
    $slog->novologin($dados['login'],$dados['senha'],$dados['cpf']);
   }
}



//testando conexao

//$con= new Conexao();

//$conectado= $con->connect()

?>




<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="#" method="POST">
  <label for="fname"> CPF: </label><br>
  <input type="text" id="cpf" name="cpf"><br>
  <label for="fname">login:</label><br>
  <input type="text" id="login" name="login"><br>
  <label for="lname">Nova Senha:</label><br>
  <input type="text" id="senha" name="senha"><br><br>
  <label for="lname">Confirma Senha:</label><br>
  <input type="text" id="senha" name="confsenha"><br><br>
  <a href="login.php">cancelar</a>
  <input type="submit" name= "entrar" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
