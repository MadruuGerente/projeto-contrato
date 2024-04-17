<?php
class Delete{
public function delete($login){
     try {
        //Incluindo a conexão
        require_once "bd_conectar.php";
        $con= new Conexao();
        //chamando a função connect() com retorno

        $conectado= $con->connect();
        //senao tive vazio continue

        if(!empty($conectado)){
            $sql= "DELETE FROM login WHERE login=:login";
            $sql=$conectado->prepare($sql);
            $sql->bindvalue("login",$login);
            //$sql->bindvalue("senha",$senha);
            
            
            
            $sql->execute();
        //verificar se tem registro 

        $rgt= $sql->rowCount();

        //criando a sessao do usuario

        if($rgt > 0) {
            // so um registro
            header("Location:login.php");
        }
        else{
            header("Location:resetsenha.php");
        }

        }else{
            header("Location:resetsenha.php");
        }
        
     } catch (Exception $e) {
        echo ("ERRO de conexao!!!!!".$e-> getMessage());
     }
}

}

//----------------------------------------FIM-------------------------------------------------



?>