<?php
class Conexao{
         //criando conexao local
private $host='localhost';
private $dbname= 'sistemateste';
private $user='root';
private $passwd='';




public function connect(){


    try {
        $pdo=new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->passwd);

        echo("conexão realidaza com sucesso");

        return $pdo;
    }
    catch (Exception $e) { echo("ERRO DE CONEXAO!!!!!!!!!".$e->getMessage());
    }
}

}
//testando conexao

$con= new Conexao();

$conectado= $con->connect();


?>