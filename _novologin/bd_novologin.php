<?php
class Novologin {
    public function novologin($login, $senha, $cpf, $nome, $perfil, $setor, $data) {
        try {
            // Incluindo a conexão
            require_once "..\bancodedados/bd_conectar.php";
            require_once "insersoes.php";
            $con = new Conexao();
            // Chamando a função connect() com retorno
            $conectado = $con->connect();

            // Se a conexão não estiver vazia, continue
            if (!empty($conectado)) {
                $sql = "INSERT INTO login (login, senha, cpf, nome, perfil, setor, dt_login) VALUES (:login, :senha, :cpf, :nome, :perfil, :setor, :data)";
                $stmt = $conectado->prepare($sql);

                // Bind dos parâmetros usando bindParam
                $stmt->bindParam(":login", $login);
                $stmt->bindParam(":senha", $senha); // Armazenar a senha sem hash no banco de dados
                $stmt->bindParam(":cpf", $cpf);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":perfil", $perfil);
                $stmt->bindParam(":setor", $setor);
                $stmt->bindParam(":data", $data);    
                $stmt->execute();

                // Verificar se houve registros afetados
                $rgt = $stmt->rowCount();

                // Criando a sessão do usuário
                if ($rgt > 0) {
                    // Sucesso
                    header("Location: ..\login/login.php?message=success");
                } else {
                    // Falha
                    header("Location: ..\login/login.php?message=failure");
                }
            } else {
                // Falha na conexão
                header("Location: ..\login/login.php?message=connection_error");
            }
        } catch (PDOException $e) {
            // Log ou tratamento mais robusto de exceções
            echo "Erro de conexão: " . $e->getMessage();
        }
    }
}
?>
