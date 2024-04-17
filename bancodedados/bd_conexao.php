<?php
class Conexao {
    // criando conexao local
    private $host = 'localhost';
    private $dbname = 'sistemaacademico';
    private $user = 'root';
    private $passwd = '';

    public function connect() {
        $mysqli = new mysqli($this->host, $this->user, $this->passwd, $this->dbname);

        if ($mysqli->connect_errno) {
            die("Falha na conexão com o banco de dados");
        }

        return $mysqli;
    }
}

$con = new Conexao();
$mysqli = $con->connect();
?>
