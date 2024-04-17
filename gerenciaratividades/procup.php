<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diretorioDestino = "..\atividades/caminho/do/diretorio/destino/"; // Substitua pelo diretório desejado

    // Verifica se o diretório de destino existe, se não, cria-o
    if (!is_dir($diretorioDestino)) {
        mkdir($diretorioDestino, 0755, true);
    }

    // Obtém o nome do destinatário selecionado
    $destinatario = $_POST["destinatario"];

    // Cria um nome de pasta único com base no timestamp e no destinatário
    $nomePasta = "atividades_" . time() . "_" . $destinatario;

    // Caminho completo do diretório de destino
    $caminhoCompleto = $diretorioDestino . $nomePasta . '/';

    // Verifica se o diretório da atividade já existe, se não, cria-o
    if (!is_dir($caminhoCompleto)) {
        mkdir($caminhoCompleto, 0755, true);
    }

    $arquivoDestino = $caminhoCompleto . basename($_FILES["arquivo"]["name"]);

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $arquivoDestino)) {
        echo "O arquivo foi enviado com sucesso. Atividade armazenada em: " . $caminhoCompleto;
    } else {
        echo "Erro ao enviar o arquivo.";
    }
}
?>
