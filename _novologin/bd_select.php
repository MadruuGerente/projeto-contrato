<?php
class Selectlogin{
public function selectlogin($cpf){
     try {
        //Incluindo a conexão
        require_once "bd_conectar.php";
        $con= new Conexao();
        //chamando a função connect() com retorno

        $conectado= $con->connect();
        //senao tive vazio continue
        SELECT cadastro.nome,login.login, login.senha FROM cadastro INNER JOIN login ON
       cadastro.cpf= login.cpf

        if(!empty($conectado)){
            $sql= "SELECT cadastro.nome,login.login, login.senha FROM cadastro INNER JOIN login ON
            cadastro.cpf= cpf";
            $sql=$conectado->prepare($sql);
            $sql->bindvalue("cpf",$cpf);
            //$sql->bindvalue("senha",$senha);
        
            
            
            $sql->execute();
        //verificar se tem registro 

        $rgt= $sql->rowCount();

        //criando a sessao do usuario

        if($rgt > 0) {
            // so um registro
            session_start();
            $_SESSION['login']= $login;
            header("Location:menu.php");
        }
        else{
            header("Location:login.php");
        }

        }else{
            header("Location:login.php");
        }
        
     } catch (Exception $e) {
        echo ("ERRO de conexao!!!!!".$e-> getMessage());
     }
}

}

//----------------------------------------FIM-------------------------------------------------



?>