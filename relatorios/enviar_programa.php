<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();
$login_de = $_SESSION['login'];
$dt_atual = date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_programa = $_POST['id_programa'] ?? "Nome não definido";
    $logins = $_POST['array_login'] ?? "Nome não definido";
    foreach ($logins as $login) {
        // echo "" . $login . "" . $id_programa . "" . $login_de . "\n";
        enviar_programa($login_de, $login, $id_programa, $dt_atual);
    }
    // echo"peguei".($).""; 
}
function enviar_programa($login_de, $login_para, $id_programa, $dt_atual)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_verifica = "SELECT * FROM enviar_programas WHERE login_de= :login_de AND login_para= :login_para AND id_programa_enviado=:id_programa_enviado";
    $stmt_verifica = $mysqli->prepare($chave_verifica);
    $stmt_verifica->bindParam(":login_de", $login_de);
    $stmt_verifica->bindParam(":login_para", $login_para);
    $stmt_verifica->bindParam(":id_programa_enviado", $id_programa);
    $stmt_verifica->execute();
    $rgt = $stmt_verifica->rowCount();
    echo("foi");
    if ($rgt == 0) {

        $chave = "INSERT INTO enviar_programas (login_de, login_para, id_programa_enviado, dt_envio) VALUES (:login_de, :login_para, :id_programa_enviado, :dt_envio)";
        $stmt = $mysqli->prepare($chave);
        $stmt->bindParam(":login_de", $login_de);
        $stmt->bindParam(":login_para", $login_para);
        $stmt->bindParam(":id_programa_enviado", $id_programa);
        $stmt->bindParam(":dt_envio", $dt_atual);
        $stmt->execute();
        $rgt = $stmt->rowCount();
    }
}
?>