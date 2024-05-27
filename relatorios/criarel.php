<script src="scripts/script_editar.js"></script>
<?php


use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ .'/dompdf/vendor/autoload.php';
require "pegar_informacoes_pdf.php";


if (isset($_GET['id'])) {
    $id_programa = $_GET['id'];
    echo ($id_programa);

    // Configurar as opções do Dompdf
    // $options = new Options();
    // $options->set('isHtml5ParserEnabled', true); // Permitir HTML5
    // $options->set('isRemoteEnabled', true); // Permitir URLs externas


    $dompdf = new Dompdf(["enable_remote" => true]);
    // Obter os dados em HTML para o PDF
    $dados_pegos = mostrar_pdf($id_programa);

    // Adicionar uma imagem com um caminho absoluto (ajuste conforme necessário)
    // $dados_pegos .= "<img src='http://seu-dominio.com/imagens/logo.png'>";

    // Carregar o HTML no Dompdf
    $dompdf->loadHtml($dados_pegos);

    // Definir o papel e a orientação
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar o PDF
    $dompdf->render();
    $dompdf->stream("file.pdf", ["Attachment" => false]);

    // Obter o conteúdo do PDF como uma string
    // $pdf_content = $dompdf->output();

    // Iniciar a sessão e armazenar o conteúdo do PDF
    session_start();
    $_SESSION['pdf_content'] = $pdf_content;

    // Redirecionar para a outra página
    header("Location: exibir_pdf.php");
    exit();
}
?>