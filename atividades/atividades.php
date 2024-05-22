<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();

$login = $_SESSION['login'];
// $chave_sql = "SELECT col_projeto.*, projetos.* FROM col_projeto
//               INNER JOIN projetos ON projetos.id_projeto = col_projeto.id_projeto
//               WHERE col_projeto.login_colaborador = ?";
$chave_programa = "SELECT enviar_programas.*, programa.nome_programa, login.nome FROM enviar_programas
               INNER JOIN programa ON enviar_programas.id_programa_enviado = programa.id_programa
               INNER JOIN login ON enviar_programas.login_de = login.login
               WHERE enviar_programas.login_para = ?";
$stmt = $mysqli->prepare($chave_programa);
$stmt->bind_param("s", $login); 
$stmt->execute();
$resultado = $stmt->get_result();
// foreach($resultado as $row){
//     echo"".$row["id_programa_enviado"]."".$row["login_de"]."";
// }
// Após inserir os dados do novo projeto no banco de dados
// $id_projeto = $mysqli->insert_id;  // Obtém o ID do projeto recém-inserido

// Criação do diretório para o projeto
// $caminho_projeto_fisico = '..\projetos/projetos/' . $id_projeto;

// if (!is_dir($caminho_projeto_fisico)) {
//     mkdir($caminho_projeto_fisico, 0777, true);  // Certifique-se de ter as permissões adequadas
// }
if ($resultado->num_rows >= 1) {
    echo "<h4>Você recebeu programa(s):</h4>";
} else {
    echo "<h4>No momento você não está em nenhum projeto!<h4>";
}
$idsEncontrados = array();
while ($dados = $resultado->fetch_assoc()) {
    // if (!in_array($dados['id_projeto'], $idsEncontrados)) {
        // $idsEncontrados[] = $dados['id_projeto'];
            // $id_projeto = $dados['id_projeto'];
            // $nome_projeto = $dados['nome_projeto'];
            // $objetivo = $dados['objetivo'];
            $view = $dados['view'];

        $id_programa = $dados['id_programa_enviado'];
        $login_de = $dados['login_de'];
        $nome_programa = $dados['nome_programa'];
        $nome_remetente = $dados['nome'];
        $id_ = $dados["id"];
        // echo $id_;

        echo '<div class="project-box">';
        if ($view == 0) {
            echo '<div class="notification-badge"></div>';
        }
        echo '<form method="POST">';
        echo '<div class="project-title">' . $nome_programa . '</div>';
        echo '<div class="project-description">Remetente: ' . $nome_remetente . '</div>';
        echo '<input type="hidden" name="data-id" value="' . $id_programa . '">';
        echo '<button type="submit" name="botao_submit" class="project-button">Ver programa</button>';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['botao_submit']) && $_POST['data-id'] == $id_programa) {
            $view = 1;
            $_SESSION['id_programa'] = $id_programa;
            

            $chave_atualizar = "UPDATE enviar_programas SET view = ? WHERE id = ?";
            $stmt_atualizar = $mysqli->prepare($chave_atualizar);
            $stmt_atualizar->bind_param("ii", $view, $id_);
           
            if($stmt_atualizar->execute()) {
                header("Location: verprogramas.php");
                exit();
            } else {
                echo("erro");
            }
        }
    // }
}
echo "</div>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/atividades.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">

    <title>Document</title>
</head>

<body class="body">
    <button onclick="teste()"> Voltar </button>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
<script>
    function teste() {
        window.location.href = `../menu/menu.php`;
    }
</script>

</html>