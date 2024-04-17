
<?php 

$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
if(!empty($dados["entrar"])){

   if(!empty($dados["login"]) ){
      require_once "bd_deletar.php";
      $slog = new Delete();
      $slog->delete($dados['login']);
    

       
   
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
  <label for="fname">login:</label><br>
  <input type="text" id="login" name="login"><br>
  <input type="submit" name= "entrar" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
