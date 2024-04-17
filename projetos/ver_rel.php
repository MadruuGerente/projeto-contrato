<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Relatórios</title>
</head>
<body>
    <h1>Selecione o Projeto para Visualizar Relatórios</h1>

    <?php
    // Substitua esses valores com suas configurações de banco de dados
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "sistemaacademico";

    // Cria a conexão com o banco de dados
    $conexao = new mysqli($hostname, $username, $password, $database);

    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Consulta SQL para obter a lista de projetos
    $sql_projetos = "SELECT id_projeto, nome_projeto FROM Projetos";
    $resultado_projetos = $conexao->query($sql_projetos);
    ?>

    <form action="" method="post">
        <label for="projeto">Escolha o Projeto:</label>
        <select name="projeto" id="projeto">
            <?php
            while ($row = $resultado_projetos->fetch_assoc()) {
                $id_projeto = $row["id_projeto"];
                $nome_projeto = $row["nome_projeto"];
                echo "<option value='$id_projeto'>$nome_projeto</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" name="visualizar_relatorios">Visualizar Relatórios</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visualizar_relatorios"])) {
        $projeto_selecionado = $_POST["projeto"];

        // Consulta SQL para recuperar os relatórios do projeto selecionado
        $sql_relatorios = "SELECT nome_relatorio, caminho_pdf
                           FROM Relatorios
                           WHERE id_projeto = '$projeto_selecionado'";
        $resultado_relatorios = $conexao->query($sql_relatorios);

        if ($resultado_relatorios->num_rows > 0) {
            echo "<h2>Relatórios para o Projeto selecionado</h2>";
            echo "<ul>";

            while ($row = $resultado_relatorios->fetch_assoc()) {
                $nome_relatorio = $row["nome_relatorio"];
                $caminho_pdf = $row["caminho_pdf"];

                echo "<li><a href='$caminho_pdf' target='_blank'>$nome_relatorio</a></li>";
            }

            echo "</ul>";
        } else {
            echo "Nenhum relatório encontrado para o projeto selecionado.";
            
        }
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
    ?>
</body>
</html>
