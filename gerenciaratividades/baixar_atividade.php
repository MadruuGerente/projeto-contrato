<?php
if (isset($_GET['atividade'])) {
    $atividadeSelecionada = $_GET['atividade'];

    $diretorioDestino = "caminho/do/diretorio/destino/"; // Substitua pelo diretório desejado

    // Caminho completo para a atividade selecionada
    $caminhoAtividade = $diretorioDestino . $atividadeSelecionada . '/';

    // Verifica se a atividade existe
    if (is_dir($caminhoAtividade)) {
        // Cria um arquivo compactado (zip) para a atividade
        $arquivoZip = $atividadeSelecionada . '.zip';
        $caminhoZip = $diretorioDestino . $arquivoZip;

        $zip = new ZipArchive();
        if ($zip->open($caminhoZip, ZipArchive::CREATE) === TRUE) {
            // Adiciona os arquivos da atividade ao arquivo zip
            $arquivosAtividade = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($caminhoAtividade),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($arquivosAtividade as $nomeArquivo => $arquivo) {
                if (!$arquivo->isDir()) {
                    $caminhoRelativo = substr($nomeArquivo, strlen($caminhoAtividade));
                    $zip->addFile($nomeArquivo, $caminhoRelativo);
                }
            }

            $zip->close();

            // Inicia o download do arquivo zip
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $arquivoZip . '"');
            header('Content-Length: ' . filesize($caminhoZip));
            readfile($caminhoZip);
        } else {
            echo 'Erro ao criar o arquivo zip.';
        }
    } else {
        echo 'Atividade não encontrada.';
    }
} else {
    echo 'Parâmetros inválidos.';
}
?>
