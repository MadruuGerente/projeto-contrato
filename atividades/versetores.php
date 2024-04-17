<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();
$id_projeto_clicado = $_SESSION['id_projeto'];
$login = $_SESSION['login'];
$chave_sql = "SELECT col_projeto.*, setor.*, projetos.*
FROM col_projeto
INNER JOIN setor ON setor.id_setor = col_projeto.id_setor AND setor.id_projeto =$id_projeto_clicado
INNER JOIN projetos ON projetos.id_projeto = col_projeto.id_projeto
WHERE col_projeto.login_colaborador = ?";
$stmt = $mysqli->prepare($chave_sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows >= 1) {
    echo "<h4>Você está em setor(s):</h4>";
} else {
    echo "<h4>No momento você não está em nenhum projeto!<h4>";
}

while ($dados = $resultado->fetch_assoc()) {
    $id_setor = $dados['id_setor'];
    $nome_setor = $dados['nome'];
    $objetivo = $dados['objetivo'];
    $objetivo_setor = $dados['objetivo_setor'];
    $view = $dados['view_setor'];

    echo '<div class="project-box">';
    if ($view == 0) {
        echo '<div class="notification-badge"></div>';
    }

    echo '<form method="POST">';
    echo '<div class="project-title">' . $nome_setor . '</div>';
    echo '<div class="project-description">Objetivo: ' . $objetivo_setor . '</div>';
    echo '<input type="hidden" name="data-id" value="' . $id_setor . '">';
    echo '<button type="submit" name="botao_submit" class="project-button1">Ver mais</button>';
    echo '</form>';
    echo '</div>';

    if (isset($_POST['botao_submit']) && $_POST['data-id'] == $id_setor) {
        $view = 1;
        $_SESSION['id_setor'] = $id_setor;
        $_SESSION['nome_setor'] = $nome_setor;
        $_SESSION['objetivo_setor'] = $objetivo;

        $chave_atualizar = "UPDATE col_projeto SET view_setor = ? WHERE id_setor = ?";
        $stmt_atualizar = $mysqli->prepare($chave_atualizar);
        $stmt_atualizar->bind_param("ii", $view, $id_setor);

        if ($stmt_atualizar->execute()) {
            header("Location: verprojetoscriados.php");
            exit();
        } else {
            // Lidar com erro na execução da atualização
        }
    }
}
echo "</div>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/atividades.css">
    <title>Document</title>
</head>
<body class="body">
</body>
</html>
