<?php
session_start();
require './dompdf/vendor/autoload.php';
require "pegar_informacoes_pdf.php";
use Dompdf\Dompdf;
use Dompdf\Options;
if (isset($_GET['id'])) {
    $id_programa = $_GET['id'];
    $options = new Options(); 
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);
    
    $dados_pegos = dados_pdf($id_programa);
    // $dados_pegos .= "<img src='" . __DIR__ . "/imagens/logo.png'>";
    
    $dompdf->loadHtml($dados_pegos);

    $dompdf->setPaper('L', 'mm', 'A4', 'true', 'UTF-8', false);
    // $dompdf->setPaper('A4', 'portrait');

    // Renderizar o PDF
    $dompdf->render();

    // Obter o conteúdo do PDF como uma string
    $pdf_content = $dompdf->output();
    // $dompdf->stream('documento.pdf');
// Iniciar a sessão e armazenar o conteúdo do PDF
    $_SESSION['pdf_content'] = $pdf_content;

    // Redirecionar para a outra página
    header("Location: exibir_pdf.php");
    exit();
    // Exibir o PDF

}
?>