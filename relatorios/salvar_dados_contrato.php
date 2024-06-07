<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo "nome_contrato" foi enviado
    if (isset($_POST["nome_contrato"])) {
        // Atribui o valor do campo "nome_contrato" a uma variável
        $nomeContrato = $_POST["nome_contrato"];
        $numero_contrato = $_POST["numero_contrato"];
        $meses_contrato = $_POST["meses_contrato"];
        $bimestre_relatorio = $_POST["bimestre_relatorio"];
        $contratante = $_POST["contratante"];
        $contratado = $_POST["contratado"];
        $periodo_abrangencia = $_POST["periodo_abrangencia"];
        $objetio_contrato_gestao = $_POST["objetio_contrato_gestao"];
        $objetivo_contratodo = $_POST["objetivo_contratodo"];
        $os_contratados = $_POST["os_contratados"];
        $contrato_gestao = $_POST["contrato_gestao"]; 
        $plano_trabalho = $_POST["plano_trabalho"]; 
        $id_do_contrato  = $_POST["id_do_contrato"]; 
        
        // Cria um array associativo com os dados do contrato
        $dadosDoContrato = array("nome_contrato" => $nomeContrato,"id_do_contrato" => $id_do_contrato);
         
        
        // Converte o array associativo para JSON
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
?>
