<?php 
require_once "..\bancodedados/bd_conectar.php";
session_start();
$id_projeto_clicado = $_SESSION['id_projeto'];
$nome_projeto = $_SESSION['nome_projeto'];
$objetivo = $_SESSION['objetivo'];
$login_criador = $_SESSION['login'];
$id_setor = $_SESSION['id_setor'];
$nome_setor = $_SESSION['nome_setor'];
$objetivo_setor = $_SESSION['objetivo_setor'];
// Faça algo com $id_projeto_clicado
//echo "ID do Projeto Clicado: " . $id_projeto_clicado . $nome_projeto .  $objetivo ;
//echo"";   
$chave_mysqli ="SELECT * FROM relatorios WHERE login_remetente=?";
$stmt = $mysqli->prepare($chave_mysqli);
$stmt->bind_Param("s", $login_criador);
$stmt->execute();
$rows = array();
$result =$stmt->get_result();
if($row = $result->fetch_assoc()){
    $rows[] = $row;   
}
$stmt->close();
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/styleverprojetos.css">
    <title>Document</title>
</head>
<body>
    
<header>
    <h1 style="font-size: 20px;">Detalhes do Projeto</h1>
</header>

<main>
    <div class="project-details">
        <h2>Setor: <?= $nome_setor;  ?></h2>
        <p>Descrição detalhada do <?= $nome_setor.': '. $objetivo_setor?> </p>
            <form method="POST" action="guardapdf.php" enctype="multipart/form-data">
            <label for="arquivo">Selecione o arquivo:</label>
            <input type="file" name="arquivo" id="arquivo" required>
            <label for="projeto_upload">Projeto:</label>
            <input type="hidden" name="projeto_upload" id="projeto_upload" value ="<?= $id_projeto_clicado; ?>"required>
            <button class="back-button" type="submit" name="upload_relatorio">Enviar relatório</button>
        </form>        
            <button class="back-button" onclick="history.back()">Voltar</button>
            
    </div>
</main>

<footer>
    &copy; 2024 Nome da Empresa
</footer>

</body>
</html>