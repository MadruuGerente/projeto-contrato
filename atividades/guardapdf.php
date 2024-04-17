<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();
$nome_projeto = $_SESSION['nome_projeto'];
$nome_setor = $_SESSION['nome_setor'];
$arquivo = $_FILES['arquivo'];
$id_setor = $_SESSION['id_setor'];
$id_projeto =$_SESSION['id_projeto'];
$login_criador=$_SESSION['login'];
date_default_timezone_set('America/Sao_Paulo');
$data = date("Y-m-d H:i:s");
// Caminho da pasta que você deseja criar
$caminhoDaPasta = '..\documentos/'. $nome_projeto. $login_criador. "/" . $nome_setor;
// Verifica se a pasta não existe antes de criar
if (!file_exists($caminhoDaPasta)) {
// Tenta criar a pasta
    if (mkdir($caminhoDaPasta, 0777, true)) {
        echo 'Pasta criada com sucesso!';
    } else {
        echo 'Erro ao criar a pasta.';
    }
} else {
    echo 'A pasta já existe.';
}
$nome_pdf = $arquivo['name'];
if($arquivo !== null){
    preg_match("/\.(pdf){1}$/i", $arquivo["name"], $ext);
    if($ext == true){
        $nome_arquivo = md5(uniqid(time())) .".".$ext[1];
        $caminho_aquivo ="..\documentos/". $nome_projeto. "/" . $nome_setor ."/" . $nome_arquivo;
        $caminho_arquivo = $caminhoDaPasta . "/" . $nome_arquivo;
        move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo);
        echo"". $data. $caminho_arquivo;
        $chave_mysql= "INSERT INTO relatorios(id_projeto, id_setor, login_remetente, nome_relatorio,
        caminho_pdf, data_upload)VALUES(?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($chave_mysql);
        $stmt->bind_Param('ssssss',$id_projeto,$id_setor,$login_criador,$nome_pdf,$caminho_arquivo,$data);
        if($stmt->execute()){
            echo"foi pivete!!";
        }else{
            echo"Algo deu errado meu mano";
        }
    }
}
echo' <button class="back-button" onclick="history.back()">Voltar</button>';
?>