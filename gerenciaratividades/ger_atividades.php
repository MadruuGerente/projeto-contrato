<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";

// Obter o login do usuário da sessão
$cpf = $_SESSION['cpf'];
// Consultar o banco de dados para obter informações do usuário
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
    <link rel="stylesheet" href="pasta_de_estilos/styleger_atividades.css">
    <title>Gerenciamento de Atividades</title>

</head>
<body class ="body">
<?php

$atividades = [];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo de atividade não está vazio
    if (!empty($_POST['atividade'])) {
        // Adiciona a atividade ao array
        $atividade = $_POST['atividade'];
        
        // Adiciona a avaliação, se fornecida
        $avaliacao = (!empty($_POST['avaliacao'])) ? $_POST['avaliacao'] : 'Não avaliado';

        $atividades[] = [
            'atividade' => $atividade,
            'avaliacao' => $avaliacao,
        ];
    }
}

// Salva as atividades em um documento (formato simples)
$documento = "Atividades:\n";
foreach ($atividades as $item) {
    $documento .= "Atividade: {$item['atividade']}\nAvaliação: {$item['avaliacao']}\n\n";
}

// Salva o documento em um arquivo (pode ser adaptado para um banco de dados)
file_put_contents('atividades.txt', $documento);

// Simula o envio das atividades (pode ser adaptado para enviar por e-mail, etc.)
function enviarAtividades($atividades) {
    // Implemente a lógica de envio aqui
    echo "Atividades enviadas com sucesso!";
}

?>

    <h2>Lista de Atividades</h2>
    <ul>
        <?php
        // Exibe a lista de atividades
        foreach ($atividades as $item) {
            echo "<li>{$item['atividade']} - Avaliação: {$item['avaliacao']}</li>";
        }
        ?>
    </ul>
</div>

<div>
    <h2 class = "h2">Adicionar Atividade</h2>

    <form class = "form" method="post" action="">
        <label class = "label" for="atividade">Atividade:</label>
        <input class = "input"type="text" name="atividade" required>

        <label class = "label" for="avaliacao">Avaliação:</label>
        <input class = "input"type="text" name="avaliacao">

        <button class = "button" type="submit">Adicionar</button>
    </form>

    <!-- Adiciona um link para baixar o arquivo com as atividades -->
    <?php if (!empty($atividades)) : ?>
        <h2>Download das Atividades</h2>
        <p><a href="atividades.txt" download>Download do arquivo de atividades</a></p>
    <?php endif; ?>

    <form method="post" action="">
        <button class = "button button:hover" type="submit" name="enviar" value="1">Enviar Atividades</button>
    </form>
</div>
<nav class = "nav">
  <a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a>
  <a href="..\perfil/perfil.php">Perfil</a>
  <a id = "ger" href = "..\menu/menu.php">Voltar menu</a>
  <?php
  if($usuario['perfil'] == 'gestor'){
    echo '<a href="..\projetos/antes_projetos.php">Projetos</a>';
    }else if($usuario['perfil'] == 'aluno'){
        echo '<a id = "ger" href = "..\atividades/atividades.php">Atividades</a>';
        echo '<a href="..\relatorios/relatorios.php">Relatorios</a>';
    }
  ?> 
</nav>
</body>
</html>