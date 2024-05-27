<?php
require_once "..\bancodedados/bd_conectar.php";

function logof(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ..\login/login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se um arquivo foi enviado
    if (isset($_FILES['img_perfil'])) {
        $anexo = $_FILES['img_perfil'];
        $cpf_user = $_POST['cpf_user'];

        // Diretório onde o anexo será salvo (ajuste conforme necessário)
        $diretorioDestino = '../imagens/img_perfil/';
        if (!file_exists($diretorioDestino)) {
            mkdir($diretorioDestino, 0777, true);
        }
        // $ponto_posicao = strrpos($anexo['name'], ".");
        // $tipo = substr($anexo['name'],$ponto_posicao + 1);
        // Mover o anexo para o diretório de destino
        if (move_uploaded_file($anexo['tmp_name'], $diretorioDestino . $cpf_user . "-". $anexo['name'])) {
            $caminhoAnexo = $diretorioDestino . $cpf_user . "-" . $anexo['name'];
            echo 'anexo enviado com sucesso.' . var_dump($anexo);
            echo(botar_img($caminhoAnexo,$cpf_user));
            // enviar_anexo($cpf_user,$caminhoAnexo,$id_indicador,$anexo['name'], $data);
        } else {
            echo 'Erro ao mover o anexo para o destino.';
        }
    } else {
        echo 'Nenhum arquivo enviado.';
    }
} else {
    echo 'Método de requisição inválido.';
}
function botar_img($caminho,$cpf){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_anexo = "UPDATE login SET img_perfil = :img_perfil, tem_img = :tem_img WHERE cpf = :cpf;";
    $tem = 1;
    $stmt = $mysqli->prepare($chave_inserir_anexo);
    $stmt->bindParam(":img_perfil", $caminho);
    $stmt->bindParam(":tem_img", $tem);     
    $stmt->bindParam(":cpf", $cpf);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
?> 