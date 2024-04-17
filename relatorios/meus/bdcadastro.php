<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemateste";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
require_once "formcompleto.php";
$sql = "INSERT INTO cadastro (nome, email, senha, sexo)
VALUES ('$name', '$email', '$senha', '$gender')";

if (mysqli_query($conn, $sql)) {
  echo "cadastrado com sucesso!";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>