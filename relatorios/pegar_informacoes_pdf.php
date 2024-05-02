<?php
require_once "..\bancodedados/bd_conectar.php";
$con = new Conexao();
$mysqli = $con->connect();
function dados_pdfe($id_programa)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM programa WHERE id_programa =:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_programa", $id_programa);
    $stmt->execute();
    $resultados_prog_met = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cont_meta = 1;
    //BOTA NO PDF 
    $dados_pdf = "<!DOCTYPE html>";
    $dados_pdf .= "<html lang='pt-br'>";
    $dados_pdf .= "<head>";
    $dados_pdf .= "<meta charset='UTF-8'>";
    $dados_pdf .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $dados_pdf .= "<title>Relatórios</title>";
    $dados_pdf .= "</head>";
    $dados_pdf .= "<body>";
    $dados_pdf .= "<h1 style='color: red;'> TESTANDO PDF </h1>";
    $dados_pdf .= '<img src="imagens/logo.png">';

    foreach ($resultados_prog_met as $resultado) {
        $cont_indicador = 1;
        $cont_meta = 1;
        $metas = pegar_metas($resultado['id_programa']);
        $dados = new stdClass();
        // $dados_pdf = new stdClass();
        $dados->nome_programa = $resultado['nome_programa'];
        $dados->id_programa = $resultado['id_programa'];
        echo ("<img src='https://sergipetec.org.br/uploads/2017/08/Logo_SergipeTec.jpg'>");
        // echo ("<h3 style='color: blue;> PROGRAMA: $dados->nome_programa  </h3><br>");

        $dados_pdf .= "<h4 style='color: blue';> PROGRAMA: $dados->nome_programa  </h4>";
        foreach ($metas as $meta) {
            $indicadores = pegar_indicadores($meta['id_meta']);
            $dados->nome_meta = $meta['nome_meta'];
            $dados->id_meta = $meta['id_meta'];

            // echo ("ID META $cont_meta: $dados->id_meta <br>");
            // echo ("NOME META $cont_meta: $dados->nome_meta <br><br>");

            $dados_pdf .= "META $cont_meta: $dados->nome_meta ";
            if ($meta['tem_indicador'] == 0) {
                $dados_pdf .= "<h5 style='color: red';> NÃO PREVISTA PARA O PERÍODO </h5>";
            }
            $cont_meta++;
            foreach ($indicadores as $indicador) {

                $dados->nome_indicador = $indicador['nome'];
                $dados->id_indicador = $indicador['id_indicador'];


                // echo ("NOME INDICADOR $cont_indicador: $dados->nome_indicador <br><br>");

                $dados_pdf .= " <br><br>INDICADOR $cont_indicador: $dados->nome_indicador <br><br>";
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

                    $dados_pdf .= " Preisao inicial :$dados->nome_previsao_inicial  <br><br>";
                    $dados_pdf .= " previsao final: $dados->nome_previsao_final  <br><br>";

                    $pegar_elementos_total = pegar_elementos_total_por_ano($indicador['id_indicador']);
                    $pegar_elemento_total = $pegar_elementos_total[0];
                    $pegar_elementos_executados = pegar_elementos_total_executados($indicador['id_indicador']);
                    $pegar_elementos_executado = $pegar_elementos_executados[0];

                    $pegar_total_contratos = pegar_tabela_contrato_ano($indicador['id_indicador']);
                    $total_contratos = $pegar_total_contratos[0]['total_contratos'];
                    $total_executadas = $pegar_total_contratos[0]['total_executados'];



                    // echo ("<br>Total contratos: $total_contratos<br>");
                    // echo ("<br>Total contratos executados: $total_executadas<br>");

                    $dados_pdf .= " Total contratos: $total_contratos <br><br>";
                    $dados_pdf .= " Total contratos executados: $total_executadas <br><br>";

                    // echo '<table border="1">';
                    $dados_pdf .= " <table border='1'>";
                    // echo '<thead>';
                    $dados_pdf .= " <thead> ";
                    // echo '<tr>';
                    $dados_pdf .= " <tr> ";
                    // echo '<td></td>';
                    $dados_pdf .= " <td></td> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo '<th>' . $ano['ano'] . '</th>';
                        $dados_pdf .= "<th> $ano[ano] </th> ";
                        //$dados_pdf .= "  $ano[ano] <br><br>";
                    }
                    // echo '</tr>';
                    $dados_pdf .= "</tr>";
                    $dados_pdf .= " </thead> ";
                    // echo '</thead>';

                    // echo '<tbody class="total-por-ano">';
                    $dados_pdf .= "<tbody class='total-por-ano'> ";
                    // echo '<tr>';
                    $dados_pdf .= "<tr> ";
                    // echo '<th>Total por ano</th>';
                    $dados_pdf .= "<th>Total por ano</th> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $dados_pdf .= "<td> $ano[valor] </td> ";
                        // $dados_pdf .= " $ano[valor] <br><br>";
                    }
                    // echo '</tr>';
                    $dados_pdf .= "</tr> ";
                    // echo '</tbody>';
                    $dados_pdf .= "</tbody> ";
                    // echo '<tfoot class="total-executado">';
                    $dados_pdf .= "<tfoot class='total-executado'>";
                    // echo '<tr>';
                    $dados_pdf .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $dados_pdf .= "<th>Total executado(ano)</th>";

                    foreach ($pegar_elementos_executados as $ano) {

                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $dados_pdf .= "<td> $ano[valor] </td>";

                    }
                    // echo '</tr>';
                    $dados_pdf .= " </tr> ";
                    // echo '</tfoot>';
                    $dados_pdf .= " </tfoot> ";
                    // echo '</table>';
                    $dados_pdf .= " </table> <br>";
                    // echo "</tr>";
                    // echo "<tr>";

                    // echo "</tr>";
                    // echo "<br>";

                    $pegar_tabela_previsoes = pegar_tabela_previsoes($indicador['id_indicador']);
                    $acumulativo = $pegar_tabela_previsoes[0]['acumulativo'];
                    $previsoes_trimestre = pegar_previsoes_trimestre($indicador['id_indicador']);
                    $realizados_trimestre = pegar_realizados_trimestre($indicador['id_indicador']);

                    // echo '<table border="1">';
                    $dados_pdf .= " <table border='1'>";
                    // echo '<thead>';
                    $dados_pdf .= " <thead>";
                    // echo '<tr>';
                    $dados_pdf .= " <tr>";
                    // echo '<td></td>';
                    $dados_pdf .= " <td></td>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo '<th>' . $trimestre['bimestre_trimestre'] . '</th>';
                        $dados_pdf .= " <th> $trimestre[bimestre_trimestre] </th>";
                    }
                    // echo '<th>' . "Acumulativo" . '</th>';
                    $dados_pdf .= " <th> Acumulativo </th>";
                    // echo '</tr>';
                    $dados_pdf .= "</tr>";
                    // echo '</thead>';
                    $dados_pdf .= "</thead>";
                    // echo '<tbody class="total-por-ano">';
                    $dados_pdf .= "<tbody class='total-por-ano'>";
                    // echo '<tr>';
                    $dados_pdf .= "<tr>";
                    // echo '<th>Total por ano</th>';
                    $dados_pdf .= "<th> Previsto no trimestre </th>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $dados_pdf .= "<td> $trimestre[valor] </td>";

                    }
                    // echo '</tr>';
                    $dados_pdf .= "</tr>";
                    // echo '</tbody>';
                    $dados_pdf .= "</tbody>";
                    // echo '<tfoot class="total-executado">';
                    $dados_pdf .= "<tfoot class='total-executado'>";
                    // echo '<tr>';
                    $dados_pdf .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $dados_pdf .= "<th> Realizado no trimestre </th>";
                    foreach ($realizados_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $dados_pdf .= "<td> $trimestre[valor] </td>";
                    }
                    // echo "<td>" . "$acumulativo" . "</td>";
                    $dados_pdf .= "<td> $acumulativo </td>";
                    // echo '</tr>';
                    $dados_pdf .= "</tr>";
                    // echo '</tfoot>';
                    $dados_pdf .= "</tfoot>";

                    // echo '</table>';
                    $dados_pdf .= "</table> <br>";

                    // echo "</tr>";
                    // echo "<tr>";
                    // echo "<br>";

                }
                $pegar_texto = pegar_texto_avaliativo($indicador['id_indicador']);
                foreach ($pegar_texto as $texto) {
                    // $dados->texto_avaliativo_1 = $texto['valor'];
                    echo ("<br>TEXTOS AVALIATIVO: $dados->texto_avaliativo_1 <br><br>");
                    $dados_pdf .= " TEXTOS AVALIATIVO $cont_text: $dados->texto_avaliativo_1 <br><br>";

                    $cont_text++;
                }
            }
            $cont_indicador = 1;
        }
    }
    $dados_pdf .= "</body>";
    return $dados_pdf;
}
function dados_pdf($id_programa)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM programa WHERE id_programa =:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_programa",$id_programa);
    $stmt->execute();
    $resultados_prog_met = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cont_meta = 1;
    //BOTA NO PDF 
    $dados_editar = "<!DOCTYPE html>";
    $dados_editar .= "<html lang='pt-br'>";
    $dados_editar .= "<head>";
    $dados_editar .= "<meta charset='UTF-8'>";
    $dados_editar .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $dados_editar .= "<title>Relatórios</title>";
    $dados_editar .= "<head>";

    $dados_editar .= "<form id='formCriarRelatorio'  method='post' action='seu_script_de_processamento.php>'"; // Início do formulário
    $dados_editar .= "<label for='relatorio'>Programa:</label><br>"; // Rótulo para o textarea  
    // Criação do textarea
    // Quebra de linha para espaçamento
    // $dados_editar .= "<input type='submit' value='Salvar Relatório'>"; // Botão de envio

    // return $dados_editar;
    $dados_pdf = "<!DOCTYPE html>";
    $dados_pdf .= "<html lang='pt-br'>";
    $dados_pdf .= "<head>";
    $dados_pdf .= "<meta charset='UTF-8'>";
    $dados_pdf .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $dados_pdf .= "<title>Relatórios</title>";
    $dados_pdf .= "</head>";
    $dados_pdf .= "<body>";
    $dados_pdf .= "<h1 style='color: red;'> TESTANDO PDF </h1>";
    $dados_pdf .= '<img src="imagens/logo.png">';

    foreach ($resultados_prog_met as $resultado) {
        $cont_indicador = 1;
        $cont_meta = 1;
        $metas = pegar_metas($resultado['id_programa']);
        $dados = new stdClass();
        // $dados_pdf = new stdClass();
        $dados->nome_programa = $resultado['nome_programa'];
        $dados->id_programa = $resultado['id_programa'];
        // echo ("<img src='https://sergipetec.org.br/uploads/2017/08/Logo_SergipeTec.jpg'>");
        // echo ("<h3 style='color: blue;> PROGRAMA: $dados->nome_programa  </h3><br>");

        $dados_pdf .= "<h4 style='color: blue';> PROGRAMA: $dados->nome_programa </h4>";
        $dados_editar .= "<textarea id='$dados->id_programa' name='relatorio' rows='2' cols='30'>$dados->nome_programa</textarea>";
        $dados_editar .= "<br>";
        foreach ($metas as $meta) {
            $indicadores = pegar_indicadores($meta['id_meta']);
            $dados->nome_meta = $meta['nome_meta'];
            $dados->id_meta = $meta['id_meta'];

            // echo ("ID META $cont_meta: $dados->id_meta <br>");
            // echo ("NOME META $cont_meta: $dados->nome_meta <br><br>");

            $dados_pdf .= "META $cont_meta: $dados->nome_meta ";
            $dados_editar .= "<label for='relatorio'>Meta $cont_meta:</label><br>"; // Rótulo para o textarea
            $dados_editar .= "<textarea id='$dados->id_meta' name='relatorio' rows='2' cols='30'>$dados->nome_meta </textarea> <br>";

            if ($meta['tem_indicador'] == 0) {
                $dados_pdf .= "<h5 style='color: red';> NÃO PREVISTA PARA O PERÍODO </h5>";
            }
            $cont_meta++;
            foreach ($indicadores as $indicador) {

                $dados->nome_indicador = $indicador['nome'];
                $dados->id_indicador = $indicador['id_indicador'];


                // echo ("NOME INDICADOR $cont_indicador: $dados->nome_indicador <br><br>");

                $dados_pdf .= " <br><br>INDICADOR $cont_indicador: $dados->nome_indicador <br><br>";

                $dados_editar .= "<label for='relatorio'>Indicador $cont_indicador:</label><br>"; // Rótulo para o textarea
                $dados_editar .= "<textarea id='$dados->id_indicador' name='relatorio' rows='2' cols='30'>$dados->nome_indicador </textarea> <br>";

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

                    $dados_pdf .= " Preisao inicial :$dados->nome_previsao_inicial  <br><br>";
                    $dados_pdf .= " previsao final: $dados->nome_previsao_final  <br><br>";

                    $dados_editar .= "<label for='relatorio'>Previsão inicial:</label><br>"; // Rótulo para o textarea
                    $dados_editar .= "<textarea id='$dados->id_previsao_inicial' name='relatorio' rows='2' cols='30'>$dados->nome_previsao_inicial </textarea> <br>";

                    $dados_editar .= "<label for='relatorio'>Previsão final:</label><br>"; // Rótulo para o textarea
                    $dados_editar .= "<textarea id='$dados->id_previsao_final' name='relatorio' rows='2' cols='30'>$dados->nome_previsao_final </textarea> <br>";

                    $pegar_elementos_total = pegar_elementos_total_por_ano($indicador['id_indicador']);
                    $pegar_elemento_total = $pegar_elementos_total[0];
                    $pegar_elementos_executados = pegar_elementos_total_executados($indicador['id_indicador']);
                    $pegar_elementos_executado = $pegar_elementos_executados[0];

                    $pegar_total_contratos = pegar_tabela_contrato_ano($indicador['id_indicador']);
                    $id_tabela_contratos = ($pegar_total_contratos[0]['id_tabela']);

                    $total_contratos = $pegar_total_contratos[0]['total_contratos'];
                    $total_executadas = $pegar_total_contratos[0]['total_executados'];



                    // echo ("<br>Total contratos: $total_contratos<br>");
                    // echo ("<br>Total contratos executados: $total_executadas<br>");

                    $dados_pdf .= " Total contratos: $total_contratos <br><br>";
                    $dados_pdf .= " Total contratos executados: $total_executadas <br><br>";
                    $dados_editar .= "Total de contratos <br>";
                    // echo '<table border="1">';
                    $dados_editar .= " <table id='$id_tabela_contratos' border='1'>";
                    // echo '<thead>';
                    $dados_editar .= " <thead> ";
                    // echo '<tr>';
                    $dados_editar .= " <tr> ";
                    // echo '<td></td>';
                    $dados_editar .= " <td></td> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo '<th>' . $ano['ano'] . '</th>';
                        $dados_editar .= "<th> $ano[ano] </th> ";
                        //$dados_editar .= "  $ano[ano] <br><br>";
                    }
                    // echo '</tr>';
                    $dados_editar .= "</tr>";
                    $dados_editar .= " </thead> ";
                    // echo '</thead>';

                    // echo '<tbody class="total-por-ano">';
                    $dados_editar .= "<tbody class='total-por-ano'> ";
                    // echo '<tr>';
                    $dados_editar .= "<tr> ";
                    // echo '<th>Total por ano</th>';
                    $dados_editar .= "<th>Total por ano</th> ";
                    foreach ($pegar_elementos_total as $ano) {
                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $dados_editar .= "<td> <input id='$ano[id_total_por_ano]' style='font-size: 15px;' value='$ano[valor]'> </td> ";
                        // $dados_editar .= " $ano[valor] <br><br>";
                    }
                    // echo '</tr>';
                    $dados_editar .= "</tr> ";
                    // echo '</tbody>';
                    $dados_editar .= "</tbody> ";
                    // echo '<tfoot class="total-executado">';
                    $dados_editar .= "<tfoot class='total-executado'>";
                    // echo '<tr>';
                    $dados_editar .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $dados_editar .= "<th>Total executado(ano)</th>";

                    foreach ($pegar_elementos_executados as $ano) {

                        // echo "<td>" . "$ano[valor]" . "</td>";
                        $dados_editar .= "<td> <input id='$ano[id_total_executados]' style='font-size: 15px;' value='$ano[valor]'> </td>";

                    }
                    // echo '</tr>';
                    $dados_editar .= " </tr> ";
                    // echo '</tfoot>';
                    $dados_editar .= " </tfoot> ";
                    // echo '</table>';
                    $dados_editar .= " </table> <br>";
                    // echo "</tr>";
                    // echo "<tr>";

                    // echo "</tr>";
                    // echo "<br>";

                    $pegar_tabela_previsoes = pegar_tabela_previsoes($indicador['id_indicador']);
                    $id_tabela_previsoes = ($pegar_tabela_previsoes[0]['id_tabela']);

                    $acumulativo = $pegar_tabela_previsoes[0]['acumulativo'];
                    $previsoes_trimestre = pegar_previsoes_trimestre($indicador['id_indicador']);
                    $realizados_trimestre = pegar_realizados_trimestre($indicador['id_indicador']);

                    // echo '<table border="1">';
                    $dados_editar .= " <table id='$id_tabela_previsoes' border='1'>";
                    // echo '<thead>';
                    $dados_editar .= " <thead>";
                    // echo '<tr>';
                    $dados_editar .= " <tr>";
                    // echo '<td></td>';
                    $dados_editar .= " <td></td>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo '<th>' . $trimestre['bimestre_trimestre'] . '</th>';
                        $dados_editar .= " <th> $trimestre[bimestre_trimestre] </th>";
                    }
                    // echo '<th>' . "Acumulativo" . '</th>';
                    $dados_editar .= " <th> Acumulativo </th>";
                    // echo '</tr>';
                    $dados_editar .= "</tr>";
                    // echo '</thead>';
                    $dados_editar .= "</thead>";
                    // echo '<tbody class="total-por-ano">';
                    $dados_editar .= "<tbody class='total-por-ano'>";
                    // echo '<tr>';
                    $dados_editar .= "<tr>";
                    // echo '<th>Total por ano</th>';
                    $dados_editar .= "<th> Previsto no trimestre </th>";
                    foreach ($previsoes_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $dados_editar .= "<td> <input style='font-size: 15px;' value='$trimestre[valor]'>  </td>";

                    }
                    // echo '</tr>';
                    $dados_editar .= "</tr>";
                    // echo '</tbody>';
                    $dados_editar .= "</tbody>";
                    // echo '<tfoot class="total-executado">';
                    $dados_editar .= "<tfoot class='total-executado'>";
                    // echo '<tr>';
                    $dados_editar .= "<tr>";
                    // echo '<th>Total executado(ano)</th>';
                    $dados_editar .= "<th> Realizado no trimestre </th>";
                    foreach ($realizados_trimestre as $trimestre) {
                        // echo "<td>" . "$trimestre[valor]" . "</td>";
                        $dados_editar .= "<td> <input style='font-size: 15px;' value='$trimestre[valor]'> </td>";
                    }
                    // echo "<td>" . "$acumulativo" . "</td>";
                    $dados_editar .= "<td>  <input style='font-size: 15px;' value='$acumulativo'>  </td>";
                    // echo '</tr>';
                    $dados_editar .= "</tr>";
                    // echo '</tfoot>';
                    $dados_editar .= "</tfoot>";

                    // echo '</table>';
                    $dados_editar .= "</table> <br>";

                    // echo "</tr>";
                    // echo "<tr>";
                    // echo "<br>";

                }
                $pegar_texto = pegar_texto_avaliativo($indicador['id_indicador']);
                foreach ($pegar_texto as $texto) {
                    $dados->texto_avaliativo_1 = $texto['valor'];
                    $dados->id_texto_avaliativo = $texto['id_texto_avaliativo'];

                    echo ("<br>TEXTOS AVALIATIVO: $dados->texto_avaliativo_1 <br><br>");
                    // $dados_editar .= " TEXTOS AVALIATIVO $cont_text: $dados->texto_avaliativo_1 <br><br>";

                    $dados_editar .= "<label for='texto_avaliativo'>TEXTOS AVALIATIVO $cont_text:</label><br>"; // Rótulo para o textarea
                    $dados_editar .= "<textarea id='$dados->id_texto_avaliativo' name='texto_avaliativo' rows='2' cols='30'>  $dados->texto_avaliativo_1  </textarea> <br>";


                    $cont_text++;
                }
            }
            $cont_indicador = 1;
        }
    }

    $dados_editar .= "<input type ='button' value='atualizar' onclick='teste()'>"; // Fim do formulário
    $dados_editar .= "</form>"; // Fim do formulário

    $dados_editar .= "</body>";
    $dados_editar .= "</html>";
    $dados_pdf .= "</body>";
    echo ($dados_editar);   
    return $dados_pdf;
}

// function atualizar_programa($id_programa, $valor_atualizado){
//     $con = new Conexao();
//     $mysqli = $con->connect();
//     $chave_sql_atualizar = "UPDATE programa SET nome_programa =:nome_programa WHERE id_programa =:id_programa";
//     $stmt = $mysqli->prepare($chave_sql_atualizar);
//     $stmt->bindParam(":nome_programa",$nome_programa);
//     $stmt->bindParam(":id_programa",$id_programa);
//     $stmt->execute();
//     $resultado = $stmt->rowCount();
//     return $resultado;
// }



function pegar_metas($id_programa)
{

    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM metas WHERE id_programa = :id_programa ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_programa", $id_programa);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
function pegar_indicadores($id_meta)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT nome, id_indicador FROM indicadores WHERE id_meta = :id_meta ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_meta", $id_meta);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
function pegar_previsoes($id_indicador)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT nome_previsao_inicial,nome_previsao_final,id_previsao_inicial, id_previsao_final FROM previsoes WHERE id_indicador = :id_indicador ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
function pegar_tabela_contrato_ano($id_indicador)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM tb_contratos WHERE id_indicador = :id_indicador ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    echo ($id_indicador);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
}
function pegar_tabela_previsoes($id_indicador)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM tb_previsoes WHERE id_indicador = :id_indicador ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}
function pegar_elementos_total_por_ano($id_indicador)
{
    $resultado_pega_contrato = pegar_tabela_contrato_ano($id_indicador);
    $id_tabela = $resultado_pega_contrato[0]['id_tabela'];

    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM total_por_ano WHERE id_tabela = :id_tabela ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_tabela", $id_tabela);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
function pegar_elementos_total_executados($id_indicador)
{
    $resultado_pega_contrato = pegar_tabela_contrato_ano($id_indicador);
    $id_tabela = $resultado_pega_contrato[0]['id_tabela'];

    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM total_executados WHERE id_tabela = :id_tabela ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_tabela", $id_tabela);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

function pegar_previsoes_trimestre($id_indicador)
{
    $resultado_pega_previsoes = pegar_tabela_previsoes($id_indicador);
    $id_tabela = $resultado_pega_previsoes[0]["id_tabela"];
    // $acumulativo = $resultado_pega_previsoes["acumulativo"];
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM previstos_no_trimestre WHERE id_tabela = :id_tabela ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_tabela", $id_tabela);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}
function pegar_realizados_trimestre($id_indicador)
{
    $resultado_pegar_preisoes = pegar_tabela_previsoes($id_indicador);
    $id_tabela = $resultado_pegar_preisoes[0]["id_tabela"];
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM realizados_no_trimestre WHERE id_tabela = :id_tabela ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_tabela", $id_tabela);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}
function pegar_texto_avaliativo($id_indicador)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM texto_avaliativo WHERE id_indicador = :id_indicador ";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    echo ($id_indicador);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>