<?php
session_start();

// Verificar se o conteúdo do PDF está na sessão
if(isset($_SESSION['pdf_content'])) {
    // Obter o conteúdo do PDF da sessão
    $pdf_content = $_SESSION['pdf_content'];

    // Limpar o buffer de saída
    ob_clean();

    // Definir o cabeçalho do tipo de conteúdo para PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="file.pdf"');

    // Exibir o conteúdo do PDF
    echo $pdf_content;
} else {
    echo "Conteúdo do PDF não encontrado na sessão.";
}
?>

