<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();

// Adicionando cabeçalho de tipo de conteúdo JSON
header('Content-Type: application/json');

// Verificar se o usuário está logado
if (!isset($_SESSION['login'])) {
    echo json_encode(['erro' => true, 'msg' => 'Usuário não está logado']);
    exit;
}

$login_criador = $_SESSION['login'];
$nome = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_STRING);

// Verificar se o nome foi fornecido
if (empty($nome)) {
    echo json_encode(['erro' => true, 'msg' => 'Nome não fornecido']);
    exit;
}

$pesq_cola = "%" . $nome . "%";

$query_cola = "SELECT id_projeto, nome_projeto, objetivo FROM projetos WHERE nome_projeto LIKE ? AND login_criador = ? LIMIT 20";

try {
    $resultado_cola = $mysqli->prepare($query_cola);

    if (!$resultado_cola) {
        throw new Exception("Erro na preparação da consulta: " . $mysqli->error);
    }

    $resultado_cola->bind_param('ss', $pesq_cola, $login_criador);
    $resultado_cola->execute();

    $resultado_cola->bind_result($id_projeto, $nome_projeto, $objetivo);
    $dados = [];

    while ($resultado_cola->fetch()) {
        $dados[] = [
            'id_projeto' => $id_projeto,
            'nome_projeto' => $nome_projeto,
            'objetivo' => $objetivo
        ];
    }

    $resultado_cola->close(); // Feche o resultado
    $mysqli->close(); // Feche a conexão

    if (!empty($dados)) {
        echo json_encode(['erro' => false, 'dados' => $dados]);
    } else {
        echo json_encode(['erro' => true, 'msg' => 'Nenhum projeto encontrado']);
    }
} catch (Exception $e) {
    echo json_encode(['erro' => true, 'msg' => $e->getMessage()]);
}
?>