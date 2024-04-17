<?php
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Verifica se a sessão foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o parâmetro relatorio está definido e é um número inteiro
if (isset($_GET['relatorio']) && is_string($_GET['relatorio'])) {
    $relatorioId = $_GET['relatorio'];

    // Verificar se o identificador do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioId])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioId], true);

        $nomeArquivo = isset($relatorio['titulo']) ? limparNomeArquivo($relatorio['titulo']) . '.pdf' : 'relatorio.pdf';

        gerarEDownloadPDF($relatorio, $nomeArquivo);
    } else {
        echo '<p>Relatório não encontrado.</p>';
        exit();
    }
} else {
    echo '<p>Parâmetro de relatório inválido.</p>';
    exit();
}

function limparNomeArquivo($nome) {
    // Substituir caracteres especiais por "_"
    $nome = preg_replace('/[^a-zA-Z0-9]/', '_', $nome);
    return $nome;
}

function gerarEDownloadPDF($relatorio, $nomeArquivo) {
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml(obterConteudoPDF($relatorio));

    // (Opcional) Configurar opções do PDF
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar o PDF (saída)
    $dompdf->render();

    // Definir cabeçalhos para realizar o download automático
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');
    header('Content-Length: ' . $dompdf->output(null, true));

    // Imprimir o conteúdo do PDF
    echo $dompdf->output();

    // Finalizar o script
    exit();
}

function obterConteudoPDF($relatorio) {
    ob_start();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Relatório</title>
        <style>
            img {
                max-width: 100%;
                max-height: 100%;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>SergipeTec</h1>
        <h2>Relatório</h2>
        <?php if (isset($relatorio['titulo'])): ?>
            <h2><?php echo $relatorio['titulo']; ?></h2>
        <?php endif; ?>

        <?php if (isset($relatorio['data_projeto']) && isset($relatorio['conclusao_projeto']) && isset($relatorio['nome_projeto'])): ?>
    <h3>Informações do Projeto:</h3>
    <table>
        <tr>
            <th>Nome do Projeto</th>
            <th>Data</th>
            <th>Porcentagem de Conclusão</th>
        </tr>
        <tr>
            <td><?php echo $relatorio['nome_projeto']; ?></td>
            <td><?php echo $relatorio['data_projeto']; ?></td>
            <td><?php echo $relatorio['conclusao_projeto']; ?>%</td>
        </tr>
    </table>
<?php endif; ?>

        <?php if (isset($relatorio['observacao'])): ?>
            <p><strong>Observação:</strong> <?php echo $relatorio['observacao']; ?></p>
        <?php endif; ?>

        <?php if (isset($relatorio['metas']) && is_array($relatorio['metas'])): ?>
            <h3>Informações do Projeto:</h3>
            <table>
                <tr>
                    <th>Meta</th>
                    <th>Prazo</th>
                    <th>Andamento</th>
                    <th>Objetivo</th>
                </tr>
                <?php foreach ($relatorio['metas'] as $index => $meta): ?>
                    <tr>
                        <td><?php echo $meta; ?></td>
                        <td><?php echo $relatorio['prazos'][$index]; ?></td>
                        <td><?php echo $relatorio['andamentos'][$index]; ?></td>
                        <td><?php echo $relatorio['objetivos'][$index]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php if (isset($relatorio['comentarios'])): ?>
            <p><strong>Comentários:</strong> <?php echo $relatorio['comentarios']; ?></p>
        <?php endif; ?>

        <?php if (isset($relatorio['anexos']) && is_array($relatorio['anexos'])): ?>
            <h3>Anexos:</h3>
            <?php foreach ($relatorio['anexos'] as $index => $anexo): ?>
                <?php if (pathinfo($anexo, PATHINFO_EXTENSION) === 'jpg' || pathinfo($anexo, PATHINFO_EXTENSION) === 'png'): ?>
                    <?php $base64 = 'data:image/' . pathinfo($anexo, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($anexo)); ?>
                    <p><a href="<?php echo $anexo; ?>" target="_blank">Anexo <?php echo ($index + 1); ?></a></p>
                <?php elseif (pathinfo($anexo, PATHINFO_EXTENSION) === 'mp4' || pathinfo($anexo, PATHINFO_EXTENSION) === 'webm' || pathinfo($anexo, PATHINFO_EXTENSION) === 'ogg'): ?>
                    <p><a href="<?php echo $anexo; ?>" target="_blank">Anexo <?php echo ($index + 1); ?></a></p>
                <?php else: ?>
                    <p>Anexo <?php echo ($index + 1); ?>: <?php echo $anexo; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
    </html>

    <?php
    return ob_get_clean();
}
?>
