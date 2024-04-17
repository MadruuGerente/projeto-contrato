<?php
if (isset($_GET['atividade'])) {
    $atividadeSelecionada = $_GET['atividade'];

    $diretorioDestino = "caminho/do/diretorio/destino/"; // Substitua pelo diretório desejado

    // Caminho completo para a atividade selecionada
    $caminhoAtividade = $diretorioDestino . $atividadeSelecionada . '/';

    // Verifica se a atividade existe
    if (is_dir($caminhoAtividade)) {
        // Pega o caminho do primeiro arquivo na atividade
        $arquivosAtividade = glob($caminhoAtividade . "*");
        if (!empty($arquivosAtividade)) {
            $primeiroArquivo = $arquivosAtividade[0];

            // Obtém o nome do arquivo
            $nomeArquivo = basename($primeiroArquivo);

            // Configura os cabeçalhos para o download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');
            header('Content-Length: ' . filesize($primeiroArquivo));

            // Envia o conteúdo do arquivo para o cliente
            readfile($primeiroArquivo);
        } else {
            echo 'Atividade vazia, sem arquivos para baixar.';
        }
    } else {
        echo 'Atividade não encontrada.';
    }
} else {
    echo 'Parâmetros inválidos.';
}
?>
