<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados["entrar"])) {
    if (!empty($dados["email"]) && !empty($dados["senha"])) {
        require_once "bdlogin.php";
        $slog = new Login(); // Certifique-se de que a classe é chamada "Login" e não "login"
        $slog->login($dados['email'], $dados['senha']);
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="#" method="POST">
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" required><br>
    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" required><br><br>
    <a href="formcompleto.php">Não possui login?</a>
    <input type="submit" value="entrar" name="entrar">
</form>

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
