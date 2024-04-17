<?php
class login{
public function login($login,$senha){
     try {
        //Incluindo a conexão
        require_once "..\bancodedados/bd_conectar.php";
        $con= new Conexao();
        //chamando a função connect() com retorno

        $conectado= $con->connect();
        //senao tive vazio continue

        if(!empty($conectado)){
            $sql= "SELECT * FROM login WHERE login=:login AND senha=:senha";
            $sql=$conectado->prepare($sql);
            $sql->bindvalue("login",$login);
            $sql->bindvalue("senha",$senha);
        
            
            
            $sql->execute();
        //verificar se tem registro 

        $rgt= $sql->rowCount();

        //criando a sessao do usuario

        if($rgt > 0) {
            // so um registro
            $dados= $sql->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['cpf']= $dados['cpf'];
            $_SESSION['login']= $dados['login'];
            //$_SESSION['nome']= $dados['nome'];
            header("Location:..\menu/menu.php");
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