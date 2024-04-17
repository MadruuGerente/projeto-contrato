<?php

class Login {
    public function login($email, $senha) {
        try {
            require_once "bd_conectar.php";
            $con = new Conexao();

            // Chamando a função connect() com retorno
            $conectado = $con->connect();

            // Se não estiver vazio, continue
            if (!empty($conectado)) {
                $sql = "SELECT * FROM cadastro WHERE email=:email";
                $stmt = $conectado->prepare($sql);
                $stmt->bindValue(":email", $email);

                $stmt->execute();

                // Verificar se há registros
                $rgt = $stmt->rowCount();

                // Criando a sessão do usuário
                if ($rgt > 0) {
                    // Apenas um registro
                    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($senha, $dados['senha'])) {
                        session_start();
                        $_SESSION['email'] = $dados['email'];
                        header("Location: menu.php");
                        exit(); // Certifique-se de encerrar o script após o redirecionamento
                    } else {
                        header("Location: login.php");
                        exit();
                    }
                } else {
                    header("Location: login.php");
                    exit();
                }
            } else {
                header("Location: login.php");
                exit();
            }
        } catch (Exception $e) {
            echo "ERRO de conexao!!!!! " . $e->getMessage();
        }
    }
}

?>
