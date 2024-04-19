<?php
class Conexao{
         //criando conexao local
private $host='localhost';
private $dbname= 'sistemaacademico';
private $user='root';
private $passwd='';




public function connect(){


    try {
        $pdo=new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->passwd);

        //echo("conexão realidaza com sucesso");

        return $pdo;
    }
    catch (Exception $e) { echo("ERRO DE CONEXAO!!!!!!!!!".$e->getMessage());
    }
}

}
$host = "localhost";
$db = "sistemaacademico";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}
//testando conexao

//$con= new Conexao();

//$conectado= $con->connect();


?>