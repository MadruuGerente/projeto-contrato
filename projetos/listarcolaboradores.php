<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();
$nome = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_STRING);
if (!empty($nome)) {
    $pesq_cola = "%" . $nome . "%";

    $query_cola = "SELECT cpf, nome, login FROM login WHERE nome LIKE ? LIMIT 20";
    $resultado_cola = $mysqli->prepare($query_cola);
    $resultado_cola->bind_param('s', $pesq_cola);
    $resultado_cola->execute();
    $resultado_cola->store_result();

    if ($resultado_cola->num_rows != 0) {
        $resultado_cola->bind_result($cpf, $nome, $login);
        $dados = [];

        while ($resultado_cola->fetch()) {
           
            $dados[] = [
                'cpf' => $cpf,
                'nome' => $nome,
                'login'=> $login
            ];
           
        }
        //$retorno = ['erro' => true, 'msg'=> 'está vazio'];
        $retorno = ['erro' => false, 'dados'=> $dados];
    } else {
        $retorno = ['erro' => true, 'msg' => 'usuario não encontrado'];
    }
} else {
    $retorno = ['erro' => true, 'msg' => 'usuario não encontrado'];
}

echo json_encode($retorno);
?>
