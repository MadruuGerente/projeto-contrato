<?php
require_once "..\bancodedados/bd_conectar.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo "nome_contrato" foi enviado
    if (isset($_POST["nome_contrato"])) {
        // Atribui o valor do campo "nome_contrato" a uma variável
        $nome_contrato = $_POST["nome_contrato"];
        $numero_contrato = $_POST["numero_contrato"];
        $meses = $_POST["meses_contrato"];
        $bimestre = $_POST["bimestre_relatorio"];
        $contratante = $_POST["contratante"];
        $contratado = $_POST["contratado"];
        $periodo_abrangencia = $_POST["periodo_abrangencia"];
        $objetivo_contrato = $_POST["objetio_contrato_gestao"];
        $objetivo_contratado = $_POST["objetivo_contratodo"];
        $os_contratados = $_POST["os_contratados"];
        $contrato_gestao = $_POST["contrato_gestao"];
        $plano_trabalho = $_POST["plano_trabalho"];
        $id_contrato = $_POST["id_do_contrato"];
        $ids_programas = $_POST["ids_programas"];
        $dt_criada = date("Y-m-d H:i:s");
        // Decodifique a string JSON para obter a array de IDs
        $ids = json_decode($ids_programas);
        $nome = "id_contrato";
        // programas(4,$nome, "2024-06-15");
        $test =json_encode(var_dump($id_contrato));
            // Cria um array associativo com os dados do contrato
            $dadosDoContrato = array(
                "nome_contrato" => $nome_contrato
                ,
                "id_do_contrato" => $id_contrato,
                "test" => $test,
                "ids" => $ids
            );

        // Converte o array associativo para JSON
        inserir_contrato(
            $id_contrato,
            $nome_contrato,
            $numero_contrato,
            $meses,
            $bimestre,
            $contratante,
            $contratado,
            $periodo_abrangencia,
            $objetivo_contrato,
            $objetivo_contratado,
            $os_contratados,
            $contrato_gestao,
            $plano_trabalho,
            $dt_criada
        );
        // programas($id_contrato,$ids_programas,$dt_criada);
        $jsonResponse = json_encode($dadosDoContrato);
        // Define o cabeçalho de resposta como JSON
        header('Content-Type: application/json');
        // Envia a resposta JSON de volta para o JavaScript
        echo $jsonResponse;
    } else {
        // Se o campo "nome_contrato" não foi enviado, exibe uma mensagem de erro
        echo "Campo 'nome_contrato' não encontrado no formulário!";
    }
} else {
    // Se o formulário não foi submetido via POST, exibe uma mensagem de erro
    echo "O formulário não foi submetido via POST!";
}
ob_end_flush();
function inserir_contrato(
    $id_contrato,
    $nome_contrato,
    $numero_contrato,
    $meses,
    $bimestre,
    $contratante,
    $contratado,
    $periodo_abrangencia,
    $objetivo_contrato,
    $objetivo_contratado,
    $os_contratados,
    $contrato_gestao,
    $plano_trabalho,
    $dt_criada
) {
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir = "INSERT INTO contratos(id_contrato, nome_contrato,numero_contrato,
    meses,bimestre,contratante,contratado,periodo_abrangencia,objetivo_contrato,objetivo_contratado,
    os_contratados,contrato_gestao,plano_trabalho,dt_criada) VALUES (:id_contrato,:nome_contrato,:numero_contrato,
    :meses,:bimestre,:contratante,:contratado,:periodo_abrangencia,:objetivo_contrato,:objetivo_contratado,
    :os_contratados,:contrato_gestao,:plano_trabalho,:dt_criada)";
    $stmt = $mysqli->prepare($chave_inserir);
    $stmt->bindParam(':id_contrato', $id_contrato);
    $stmt->bindParam(':nome_contrato', $nome_contrato);
    $stmt->bindParam(':numero_contrato', $numero_contrato);
    $stmt->bindParam(':meses', $meses);
    $stmt->bindParam(':bimestre', $bimestre);
    $stmt->bindParam(':contratante', $contratante);
    $stmt->bindParam(':contratado', $contratado);
    $stmt->bindParam(':periodo_abrangencia', $periodo_abrangencia);
    $stmt->bindParam(':objetivo_contrato', $objetivo_contrato);
    $stmt->bindParam(':objetivo_contratado', $objetivo_contratado);
    $stmt->bindParam(':os_contratados', $os_contratados);
    $stmt->bindParam(':contrato_gestao', $contrato_gestao);
    $stmt->bindParam(':plano_trabalho', $plano_trabalho);
    $stmt->bindParam(':dt_criada', $dt_criada);
    $stmt->execute();
}
function programas($t, $g, $h)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    // Valores que você deseja inserir
    $id_contrato = 1;
    $ids = 2;
    $dt_criada = "2024-06-15";

    // Consulta SQL com marcadores de posição nomeados
    $chave_inserir = "INSERT INTO contratos_programas (id_contrato, id_programa, dt_criada) VALUES (:id_contrato, :id_programa, :dt_criada)";

    // Substituir os marcadores de posição pelos valores reais
    $chave_inserir = str_replace(
        [":id_contrato", ":id_programa", ":dt_criada"],
        [$t, $g, $h],
        $chave_inserir
    );

    // Preparar a declaração SQL
    $stmt = $mysqli->prepare($chave_inserir);

    // Execute a consulta preparada
    $stmt->execute();
}
?>