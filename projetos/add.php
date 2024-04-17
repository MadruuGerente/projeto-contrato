<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemaacademico";

try {
    // Cria a conexão
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Define o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL
    $sql = "SELECT * FROM login WHERE perfil = 'funcionario'";
    
    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Executa a consulta
    $stmt->execute();

    // Retorna os resultados
    $result = $stmt->fetchAll();

    // Verifica se a consulta retornou resultados
    if (count($result) > 0) {
        // Exibe os dados de cada linha
        foreach ($result as $row) {
            echo " - Nome: " . $row["nome"] . " - Perfil: " . $row["perfil"] . "<br>";
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

// Fecha a conexão
$conn = null;
?>
