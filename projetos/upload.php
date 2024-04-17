<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_relatorio"])) {
    // Verifica se o projeto e o setor foram fornecidos
    $projeto = $_POST["projeto_upload"];
    $setor = $_POST["setor_upload"];

    if (empty($projeto) || empty($setor)) {
        echo "Por favor, forneça o projeto e o setor.";
    } else {

        // Cria a pasta do projeto se não existir
        $caminho_projeto = 'projetos/' . DIRECTORY_SEPARATOR . $projeto  .'/' . DIRECTORY_SEPARATOR . $setor;
        if (!file_exists($caminho_projeto)) {
            mkdir($caminho_projeto, 0777, true);
        }

        // Move o arquivo para a pasta do projeto
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
        $nome_arquivo = basename($_FILES["arquivo"]["name"]);
        $caminho_destino = $caminho_projeto . '/' . $nome_arquivo;

        if (move_uploaded_file($arquivo_temporario, $caminho_destino)) {

            // Inserir informações no banco de dados
            $conexao = new mysqli("localhost", "root", "", "sistemaacademico");

            if ($conexao->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
            }

            // Verificar se o projeto existe e obter o ID
            $verifica_projeto = "SELECT projetos.*, setor.* FROM projetos 
                    INNER JOIN setor ON projetos.id_projeto = setor.id_projeto 
                    WHERE projetos.nome_projeto = '$projeto'";

            $resultado = $conexao->query($verifica_projeto);

            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $id_projeto = $row["id_projeto"];
                $id_setor = $row["id_setor"]; 

                // Continue com a inserção do relatório
                $nome_relatorio = $nome_arquivo;
                $caminho_pdf = $caminho_destino;
                $login_remetente = $_SESSION["login"];
                $sql = "INSERT INTO Relatorios (id_setor, id_projeto, nome_relatorio, login_remetente, caminho_pdf)
                 VALUES ('$id_setor', '$id_projeto','$nome_relatorio', '$login_remetente', '$caminho_pdf')";

                if ($conexao->query($sql) === TRUE) {
                    echo "oii login $login_remetente enviado com sucesso para o projeto $projeto, setor $setor e registrado no banco de dados.";
                } else {
                    echo "Erro ao enviar o relatório e registrar no banco de dados: " . $conexao->error;
                }
            } else {
                echo "O projeto não foi encontrado na tabela Projetos.";
            }

            $conexao->close();

        } else {
            echo "Erro ao enviar o relatório.";
        }
    }
}
?>