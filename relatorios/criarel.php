<?php
// Incluir a biblioteca TCPDF
require_once ('../tcpdf/tcpdf.php');
require_once ('pegar_informacoes_pdf.php');


if (isset($_GET['id'])) {
    $id_programa = $_GET['id'];
    // echo ($id_programa);
    // $html = mostrar_pdf($id_programa);
    // echo $html;
    // Criar uma nova instância do TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Definir informações do documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Seu Nome');
    $pdf->SetTitle('Título do Documento');
    $pdf->SetSubject('Assunto do Documento');
    $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');

    // Definir cabeçalho e rodapé
    $pdf->setHeaderData('logopdf.png', 40, "Parque Tecnologico do SergipeTec", 'www.sergipetec.com.br');
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // Definir fonte para cabeçalho e rodapé
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Definir fonte padrão
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Definir margens
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Definir quebra automática de páginas
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Definir fator de escala de imagem
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Definir fonte
    $pdf->SetFont('dejavusans', '', 10);

    // Adicionar uma página
    $pdf->AddPage();

    // Adicionar uma imagem antiga (para simulação de substituição)
    // $pdf->Image('imagens/sergipelogo.png', 15, 140, 75, '', 'PNG', '', 'T', false, 300, '', false, false, 1, false, false, false);
    $html = "ffdf";
    // Definir conteúdo HTML
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM programa WHERE id_programa =:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_programa", $id_programa);
    $stmt->execute();
    $resultados_prog_met = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cont_meta = 1;
    $id = $id_programa;
    //BOTA NO PDF 
    $html .= "ffdf";
    $html = "<!DOCTYPE html>";
    $html .= "<html lang='pt-br'>";
    $html .= "<head>";
    $html .= "<meta charset='UTF-8'>";
    $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $html .= "<title>Relatórios</title>";

   
    foreach ($resultados_prog_met as $resultado) {
        $cont_indicador = 1;
        $cont_meta = 1;
        $metas = pegar_metas($resultado['id_programa']);
        $dados = new stdClass();
        $dados_pdf = new stdClass();
        $dados->nome_programa = $resultado['nome_programa'];
        $dados->id_programa = $resultado['id_programa'];
        // echo ("<img src='https://sergipetec.org.br/uploads/2017/08/Logo_SergipeTec.jpg'>");
        // echo ("<h3 style='color: blue;> PROGRAMA: $dados->nome_programa  </h3><br>");

        // $dados_pdf .= "<h4 style='color: blue';> PROGRAMA: $dados->nome_programa </h4>";

        $html .= "<body>";

        $html .= "<br><label class='programa-valor'  style='font-size: 50px; color: red;' name='relatorio'>PROGRAMA:     </label>";
        $html .= "<label class='programa-valor' id='$dados->id_programa'name='relatorio'>$dados->nome_programa</label><br>";


        // $html .= "<h3>hoihui</h3>";

        $html .= "</body>";
        $html .= "</html>";


      
        foreach ($metas as $meta) {
            $indicadores = pegar_indicadores($meta['id_meta']);
            $dados->nome_meta = $meta['nome_meta'];
            $dados->id_meta = $meta['id_meta'];

            // echo ("ID META $cont_meta: $dados->id_meta <br>");
            // echo ("NOME META $cont_meta: $dados->nome_meta <br><br>");

            // $dados_pdf .= "META $cont_meta: $dados->nome_meta ";
            $html .= "<label class='meta' for='relatorio' > Meta $cont_meta:</label>"; // Rótulo para o textarea
            $html .= "<label class='meta-valor' id='$dados->id_meta' name='relatorio' >$dados->nome_meta </label> <br>";

           
            if ($meta['tem_indicador'] == 0) {
                // $dados_pdf .= "<h5 style='color: red';> NÃO PREVISTA PARA O PERÍODO </h5>";
            }
            $cont_meta++;
            foreach ($indicadores as $indicador) {

                $dados->nome_indicador = $indicador['nome'];
                $dados->id_indicador = $indicador['id_indicador'];


                // echo ("NOME INDICADOR $cont_indicador: $dados->nome_indicador <br><br>");

                // $dados_pdf .= " <br><br>INDICADOR $cont_indicador: $dados->nome_indicador <br><br>";

                $html .= "<label class='indicador' for='relatorio'>  Indicador $cont_indicador:</label>"; // Rótulo para o textarea
                $html .= "<label class='indicador-valor' id='$dados->id_indicador' name='relatorio' rows='2' cols='30'>$dados->nome_indicador </label> <br>";

             
                //    echo ("ID INDICADOR: $dados->id_indicador <br><br>");
                $cont_indicador++;
                $previsoes = pegar_previsoes($indicador['id_indicador']);
                $cont_text = 1;
                foreach ($previsoes as $preisao) {
                    $dados->nome_previsao_inicial = $preisao['nome_previsao_inicial'];
                    $dados->id_previsao_inicial = $preisao['id_previsao_inicial'];
                    $dados->nome_previsao_final = $preisao['nome_previsao_final'];
                    $dados->id_previsao_final = $preisao['id_previsao_final'];


                    // echo (" CRONOGRAMA DE EXECUÇÃO: <br>");
                    // echo ("Preisao inicial : $dados->nome_previsao_inicial <br>");
                    // echo ("previsao final: $dados->nome_previsao_final <br><br>");

                    // $dados_pdf .= " Preisao inicial :$dados->nome_previsao_inicial  <br><br>";
                    // $dados_pdf .= " previsao final: $dados->nome_previsao_final  <br><br>";

                   
                    $html .= "<label class='preisao' for='relatorio'>    Previsão final:</label>"; // Rótulo para o textarea
                    $html .= "<label class='preisao-valor' id='$dados->id_previsao_final' name='relatorio' rows='2' cols='30'>$dados->nome_previsao_final </label><br><br> ";

                
                    $html .= "<label class='preisao' for='relatorio'> Previsão final:</label>"; // Rótulo para o textarea
                    $html .= "<label class='preisao-valor' id='$dados->id_previsao_final' name='relatorio' rows='2' cols='30'>$dados->nome_previsao_final </label><br><br> ";

                    $pegar_elementos_total = pegar_elementos_total_por_ano($indicador['id_indicador']);
                    $pegar_elemento_total = $pegar_elementos_total[0];
                    $pegar_elementos_executados = pegar_elementos_total_executados($indicador['id_indicador']);
                    $pegar_elementos_executado = $pegar_elementos_executados[0];

                    $pegar_total_contratos = pegar_tabela_contrato_ano($indicador['id_indicador']);
                    $id_tabela_contratos = ($pegar_total_contratos[0]['id_tabela']);

                    $total_contratos = $pegar_total_contratos[0]['total_contratos'];
                    $total_executadas = $pegar_total_contratos[0]['total_executados'];

                    $html .= " <label  style='font-size:20px; margin-left: 20px;'>Total de contratos</label><br><br>";
                    // echo '<table border="1">';
                    $html .= " <table id='$id_tabela_contratos' border='1'>";
                    // echo '<thead>';
                    $html .= " <thead> ";
                    // echo '<tr>';
                    $html .= " <tr> ";
                    // echo '<td></td>';
                    $html .= " <td></td> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo '<th>' . $ano['ano'] . '</th>';
                        $html .= "<th> $ano[ano] </th> ";
                        //$html .= "  $ano[ano] <br><br>";
                    }
                    // echo '</tr>';
                    $html .= "</tr>";
                    $html .= " </thead> ";
                    // echo '</thead>';

                    // echo '<tbody class="total-por-ano">';
                    $html .= "<tbody class='total-por-ano'> ";
                    // echo '<tr>';
                    $html .= "<tr> ";
                    // echo '<th>Total por ano</th>';
                    $html .= "<th>Total por ano  </th> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $html .= "<td>    $ano[valor]</td> ";
                        // $html .= " $ano[valor] <br><br>";
                    }
                    // echo '</tr>';
                    $html .= "</tr> ";
                    // echo '</tbody>';
                    $html .= "</tbody> ";
                    // echo '<tfoot class="total-executado">';
                    $html .= "<tfoot class='total-executado'>";
                    // echo '<tr>';
                    $html .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $html .= "<th>Total executado(ano)</th>";

                    foreach ($pegar_elementos_executados as $ano) {

                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $html .= "<td>    $ano[valor]</td>";

                    }
                    // echo '</tr>';
                    $html .= " </tr> ";
                    // echo '</tfoot>';
                    $html .= " </tfoot> ";
                    // echo '</table>';
                    $html .= " </table> <br>";


                    // echo ("<br>Total contratos: $total_contratos<br>");
                    // echo ("<br>Total contratos executados: $total_executadas<br>");

                

                    $pegar_tabela_previsoes = pegar_tabela_previsoes($indicador['id_indicador']);
                    $id_tabela_previsoes = ($pegar_tabela_previsoes[0]['id_tabela']);

                    $acumulativo = $pegar_tabela_previsoes[0]['acumulativo'];
                    $previsoes_trimestre = pegar_previsoes_trimestre($indicador['id_indicador']);
                    $realizados_trimestre = pegar_realizados_trimestre($indicador['id_indicador']);

                    $html .= " <table id='$id_tabela_previsoes' border='1'>";
                    // echo '<thead>';
                    $html .= " <thead>";
                    // echo '<tr>';
                    $html .= " <tr>";
                    // echo '<td></td>';
                    $html .= " <td></td>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo '<th>' . $trimestre['bimestre_trimestre'] . '</th>';
                        $html .= " <th> $trimestre[bimestre_trimestre] </th>";
                    }
                    // echo '<th>' . "Acumulativo" . '</th>';
                    $html .= " <th> Acumulativo </th>";
                    // echo '</tr>';
                    $html .= "</tr>";
                    // echo '</thead>';
                    $html .= "</thead>";
                    // echo '<tbody class="total-por-ano">';
                    $html .= "<tbody class='previsto'>";
                    // echo '<tr>';
                    $html .= "<tr>";
                    // echo '<th>Total por ano</th>';
                    $html .= "<th> Previsto no trimestre </th>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $html .= "<td> $trimestre[valor]</td>";

                    }
                    // echo '</tr>';
                    $html .= "</tr>";
                    // echo '</tbody>';
                    $html .= "</tbody>";
                    // echo '<tfoot class="total-executado">';
                    $html .= "<tfoot class='realizado'>";
                    // echo '<tr>';
                    $html .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $html .= "<th> Realizado no trimestre </th>";
                    foreach ($realizados_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $html .= "<td> $trimestre[valor]</td>";
                    }
                    // echo "<td>" . "$acumulativo" . "</td>";
                    $html .= "<td> $acumulativo  </td>";
                    // echo '</tr>';
                    $html .= "</tr>";
                    // echo '</tfoot>';
                    $html .= "</tfoot>";

                    // echo '</table>';
                    $html .= "</table> <br>";

                    // echo "</tr>";
                    // echo "<tr>";
                    // echo "<br>";

                }
                $pegar_texto = pegar_texto_avaliativo($indicador['id_indicador']);
                foreach ($pegar_texto as $texto) {
                    $dados->texto_avaliativo_1 = $texto['valor'];
                    $dados->id_texto_avaliativo = $texto['id_texto_avaliativo'];

                    // echo ("<br>TEXTOS AVALIATIVO: $dados->texto_avaliativo_1<br><br>");
                    // $html .= " TEXTOS AVALIATIVO $cont_text: $dados->texto_avaliativo_1 <br><br>";

                    $html .= "<label class='texto-avaliativo' for='texto_avaliativo'>TEXTOS AVALIATIVO $cont_text:</label>"; // Rótulo para o textarea
                    $html .= "<label class='texto-avaliativo-valor' id='$dados->id_texto_avaliativo' name='texto_avaliativo' rows='2' cols='30'>$dados->texto_avaliativo_1</label  > <br>";


                    $cont_text++;
                }
                $pegar_anexos = pegar_anexos($indicador['id_indicador']);
                foreach ($pegar_anexos as $anexos) {
                    $html .= "<a class= 'anexos' href = '$anexos[caminho_anexo]'>$anexos[nome_anexo]</a> <br><br>";
                }
            }
            $cont_indicador = 1;

        }
        $pegar_texto = pegar_texto_avaliativo($indicador['id_indicador']);
        foreach ($pegar_texto as $texto) {
            $dados->texto_avaliativo_1 = $texto['valor'];
            $dados->id_texto_avaliativo = $texto['id_texto_avaliativo'];

            // echo ("<br>TEXTOS AVALIATIVO: $dados->texto_avaliativo_1<br><br>");
            // $dados_editar .= " TEXTOS AVALIATIVO $cont_text: $dados->texto_avaliativo_1 <br><br>";

            $cont_text++;
        }
        $pegar_anexos = pegar_anexos($indicador['id_indicador']);
        foreach ($pegar_anexos as $anexos) {
            $caminho_pasta = $_SERVER['DOCUMENT_ROOT'] . "$anexos[caminho_anexo]";

            $html  .= "<a href = ' $caminho_pasta'>TEXTA I SBI</a> <br><br>";

            $pdf->writeHTML('<a href="'.$caminho_pasta .'">Clique aqui para visitar o site</a>');
        }
    }
    $cont_indicador = 1;

    
    $pdf->writeHTML($html, true, false, true, false, '');


    // Fechar e sair do PDF
    // ob_end_clean();  
    $pdf->lastPage();
    $pdf->Output('exemplo.pdf', 'I');
}
?>