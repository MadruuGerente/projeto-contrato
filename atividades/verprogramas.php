<?php
session_start();
// session_start();
require './dompdf/vendor/autoload.php';
require_once "../relatorios/pegar_informacoes_pdf.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$id_programa = 0;
// if (isset($_GET['id'])) {
$id_programa = $_SESSION['id_programa'];
$options = new Options();
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dados_pegos = mostrar_pdf($id_programa);    
echo ($dados_pegos); 
// }

// require_once "..\bancodedados/bd_conectar.php";
// $id_projeto_clicado = $_SESSION['id_programa'];
// $login = $_SESSION['login'];
// $chave_sql = "SELECT col_projeto.*, setor.*, projetos.*
// FROM col_projeto
// INNER JOIN setor ON setor.id_setor = col_projeto.id_setor AND setor.id_projeto =$id_projeto_clicado
// INNER JOIN projetos ON projetos.id_projeto = col_projeto.id_projeto
// WHERE col_projeto.login_colaborador = ?";


// $stmt = $mysqli->prepare($chave_sql);
// $stmt->bind_param("s", $login);
// $stmt->execute();
// $resultado = $stmt->get_result();

// if ($resultado->num_rows >= 1) {
//     echo "<h4>Você está em setor(s):</h4>";
// } else {
//     echo "<h4>No momento você não está em nenhum projeto!<h4>";
// }

// while ($dados = $resultado->fetch_assoc()) {
//     $id_setor = $dados['id_setor'];
//     $nome_setor = $dados['nome'];
//     $objetivo = $dados['objetivo'];
//     $objetivo_setor = $dados['objetivo_setor'];
//     $view = $dados['view_setor'];

//     echo '<div class="project-box">';
//     if ($view == 0) {
//         echo '<div class="notification-badge"></div>';
//     }

//     echo '<form method="POST">';
//     echo '<div class="project-title">' . $nome_setor . '</div>';
//     echo '<div class="project-description">Objetivo: ' . $objetivo_setor . '</div>';
//     echo '<input type="hidden" name="data-id" value="' . $id_setor . '">';
//     echo '<button type="submit" name="botao_submit" class="project-button1">Ver mais</button>';
//     echo '</form>';
//     echo '</div>';

//     if (isset($_POST['botao_submit']) && $_POST['data-id'] == $id_setor) {
//         $view = 1;
//         $_SESSION['id_setor'] = $id_setor;
//         $_SESSION['nome_setor'] = $nome_setor;
//         $_SESSION['objetivo_setor'] = $objetivo;

//         $chave_atualizar = "UPDATE col_projeto SET view_setor = ? WHERE id_setor = ?";
//         $stmt_atualizar = $mysqli->prepare($chave_atualizar);
//         $stmt_atualizar->bind_param("ii", $view, $id_setor);

//         if ($stmt_atualizar->execute()) {
//             header("Location: verprojetoscriados.php");
//             exit();
//         } else {
//             // Lidar com erro na execução da atualização
//         }
//     }
// }
// echo "</div>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/atividades.css">
    <title>Document</title>
</head>
<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }
    .content {
        margin-top: 700px;
        position: relative;
        width: 80%;
        max-width: 600px;
        min-width: 100px;
        /* Limita o tamanho máximo do contêiner */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px auto;
    }
    table {
        margin-left: 20px;
        width: auto;
        max-width: 0.5px;
        overflow: auto;
        margin-bottom: 10px;
    }
    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }
    th {
        background-color: #7B68EE;
        color: #fff;
        font-weight: bold;
    }
    nav {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: #333;
        overflow: hidden;
        text-align: center;
        padding: 10px;
    }
    nav a {
        display: inline-block;
        color: white;
        padding: 10px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    nav a:hover {
        background-color: #555;
    }

    .programa {
        /* color: #4D4DFF; */
        /* background-color: beige; */
        font-size: 25px;
        font-weight: bold;

    }

    .programa-valor {
        font-weight: normal;
        /* background-color: bisque; */
        border: 2px;
        /* color: #9932CD; */
        font-size: 25px;
    }

    .meta {
        font-weight: bold;
        /* margin-left: 15px; */
        font-size: 25px;
    }

    .meta-valor {
        /* margin-left: px; */
        font-size: 25px;
    }

    .indicador {
        font-weight: bold;
        margin-left: 15px;
        font-size: 20px;
    }

    .indicador-valor {
        font-size: 20px;
        margin-left: 15px;

    }

    .preisao {
        font-weight: bold;
        margin-left: 30px;
        font-size: 20px;
    }

    .preisao-valor {
        font-size: 20px;
    }

    .texto-avaliativo {
        font-size: 20px;
        margin-left: 20px;
    }

    .texto-avaliativo-valor {
        font-size: 20px;
        margin-left: 20px;
    }

    .nao-previsto {}
</style>
<body>
    
</body>
</html>