<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require_once "..\bancodedados/bd_conectar.php";
// Obter o login do usuário da sessão
$cpf = $_SESSION['cpf'];

// Inicializar variável de status
$status = '';
$uploadStatus = '';

// Processar o envio do formulário de status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_form'])) {
    // Obter o status do formulário
    $novoStatus = $_POST['status'];

    // Atualizar o status no banco de dados
    try {
        $conexao = new Conexao();
        $conn = $conexao->connect();

        // Atualizar o status do usuário
        $sql = "UPDATE login SET status = :status WHERE cpf = :cpf";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $novoStatus);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        $status = 'Status atualizado com sucesso.';
    } catch (Exception $e) {
        echo "DEBUG: Erro de conexão: " . $e->getMessage();
        exit();
    } finally {
        // Fechar a conexão com o banco de dados
        $conn = null;
    }
}

// Processar o envio do formulário de foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_form'])) {
    // Diretório onde as fotos de perfil serão armazenadas
    $photoDir = 'uploads/profile_photos/';

    // Nome único para o arquivo de destino
    $photoFileName = $login . '_' . time() . '_' . basename($_FILES['photo']['name']);
    $photoPath = $photoDir . $photoFileName;

    // Verificar se o arquivo é uma imagem real
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
        // Tentar mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $uploadStatus = 'Foto de perfil atualizada com sucesso.';
        } else {
            $uploadStatus = 'Erro ao fazer o upload da foto de perfil.';
        }
    } else {
        $uploadStatus = 'O arquivo não é uma imagem válida.';
    }
}

// Consultar o banco de dados para obter informações do usuário
try {
    $conexao = new Conexao();
    $conn = $conexao->connect();

    // Consultar informações do usuário usando o campo de login
    $sql = "SELECT * FROM login WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $login);
    $stmt->execute();

    // Obter os resultados da consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se a consulta retornou resultados
    if (!$usuario) {
        echo "DEBUG: Usuário não encontrado no banco de dados.";
        exit();
    }
} catch (Exception $e) {
    echo "DEBUG: Erro de conexão: " . $e->getMessage();
    exit();
} finally {
    // Fechar a conexão com o banco de dados
    $conn = null;
}
?>