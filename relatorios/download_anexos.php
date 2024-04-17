<?php
session_start();

if (
    isset($_GET['relatorio']) && filter_var($_GET['relatorio'], FILTER_VALIDATE_INT) &&
    isset($_GET['anexo']) && filter_var($_GET['anexo'], FILTER_VALIDATE_INT)
) {
    $relatorioIndex = $_GET['relatorio'];
    $anexoIndex = $_GET['anexo'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);

        // Verificar se o índice do anexo existe no relatório
        if (isset($relatorio['anexos'][$anexoIndex])) {
            $anexo = $relatorio['anexos'][$anexoIndex];

            // Fornecer o anexo para download
            header('Content-type: ' . mime_content_type($anexo));
            header('Content-Disposition: attachment; filename="' . basename($anexo) . '"');
            readfile($anexo);
            exit();
        } else {
            echo '<p>Anexo não encontrado.</p>';
        }
    } else {
        echo '<p>Relatório não encontrado.</p>';
    }
} else {
    echo '<p>Parâmetros inválidos.</p>';
}
?>
