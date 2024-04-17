
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Envio de Arquivo</title>
</head>
<body>
    <h2>Envie um arquivo</h2>
    <form action="procup.php" method="post" enctype="multipart/form-data">
        <label for="arquivo">Escolha um arquivo:</label>
        <input type="file" name="arquivo" id="arquivo" required>
        <br>
        <!-- Adicione o campo de seleção de destinatário -->
        <label for="destinatario">Selecione o destinatário:</label>
        <select name="destinatario" id="destinatario" required>
            <!-- Preencha as opções com os nomes dos destinatários do banco de dados -->
            <?php
            $conn = new mysqli("localhost", "root", "", "sistemaacademico");

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Consulta SQL para obter os nomes dos destinatários da tabela login
            $sql = "SELECT nome FROM login";
            $result = $conn->query($sql);

            // Exibe as opções do menu suspenso
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
            }

            $conn->close();
            ?>
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
