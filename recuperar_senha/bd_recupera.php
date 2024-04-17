<?php
require_once "..\bancodedados/bd_conectar.php";
$con = new Conexao();
$mysqli = $con->connect();

function verifica($login, $cpf)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave = "SELECT * FROM login WHERE login=:login AND cpf= :cpf";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->execute();
    $rgt  = $stmt->rowCount();
    return $rgt;
}
function atualizarSenha($cpf, $senha){
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave = "UPDATE login SET senha=:senha WHERE cpf=:cpf";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":senha",$senha);
    $stmt->bindParam(":cpf",$cpf);
    $stmt->execute();
    $rgt  = $stmt->rowCount();
    return $rgt;
}
?>