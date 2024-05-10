<?php
require_once "..\bancodedados/bd_conectar.php";
use FTP\Connection;

echo ("fhfghfd");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programa_valor = $_POST['programa_valor'] ?? "Nome não definido";
    $programa_id = $_POST['programa_id'] ?? "Nome não definido";
    echo "Nome: $programa_valor, Id: $programa_id ";

    if ($programa_id != null) {
        $veri = atualizar_programa($programa_id, $programa_valor);
        echo ("fgdfgddgdf$veri");
        $meta_cont = 0;
        $indicador_cont = 1;
        do {
            $meta_cont++;
            $meta_valor = $_POST["meta_valor_$meta_cont"] ?? 0;
            $meta_id = $_POST["meta_id_$meta_cont"] ?? 0;
            if ($meta_valor != 0) {
                echo ("meta: $meta_valor\n");
                echo ("meta: $meta_id");
                atualizar_meta($meta_id, $meta_valor);
                do {

                    $indicador_valor = $_POST["indicador_valor_$meta_cont$indicador_cont"] ?? 0;
                    $indicador_id = $_POST["indicador_id_$meta_cont$indicador_cont"] ?? 0;

                    if ($indicador_id != 0) {
                        echo ("$indicador_valor -- $indicador_id\n");
                        atualizar_indicador($indicador_id, $indicador_valor);
                        $teste = "text_inicial_valor_$meta_cont$indicador_cont";

                        $previsao_inicial_valor = $_POST["text_inicial_valor_$meta_cont$indicador_cont"] ?? 0;
                        $previsao_inicial_id = $_POST["text_inicial_cont_id_$meta_cont$indicador_cont"] ?? 0;

                        $previsao_final_valor = $_POST["text_final_valor_$meta_cont$indicador_cont"] ?? 0;
                        $previsao_final_id = $_POST["text_final_cont_id_$meta_cont$indicador_cont"] ?? 0;

                        echo ("INICIAL $previsao_inicial_id FINAL $previsao_final_id");
                        echo ("TRVOOO$teste");
                        atualizar_previsoes($previsao_inicial_id, $previsao_final_id, $previsao_inicial_valor, $previsao_final_valor);
                        $text_avaliativo_cont = 1;
                        do {
                            $text_avaliativo_valor = $_POST["text_texto_avaliativo_$meta_cont$indicador_cont$text_avaliativo_cont"] ?? 0;
                            $text_avaliativo_id = $_POST["text_texto_avaliativo_id_$meta_cont$indicador_cont$text_avaliativo_cont"] ?? 0;
                            echo ("BUTTO:$text_avaliativo_valor$text_avaliativo_id");
                            echo("YESHUAA". atualizar_text_avaliativo($text_avaliativo_valor,$text_avaliativo_id));    
                            $text_avaliativo_cont++;
                        } while ($text_avaliativo_valor != 0);
                        $indicador_cont++;
                    }

                } while ($indicador_valor != 0);

            }


        } while ($meta_valor != 0); // Continua enquanto o contador for menor que 5
    }


} else {
    echo "A solicitação não é POST.";
}
function atualizar_programa($id_programa, $valor_atualizado)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave = "UPDATE programa SET nome_programa = :valor_atualizado WHERE id_programa = :id_programa";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":valor_atualizado", $valor_atualizado);
    $stmt->bindParam(":id_programa", $id_programa);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function atualizar_meta($id_meta, $valor_atualizado)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave = "UPDATE metas SET nome_meta = :valor_atualizado WHERE id_meta = :id_meta";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":valor_atualizado", $valor_atualizado);
    $stmt->bindParam(":id_meta", $id_meta);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function atualizar_indicador($id_indicador, $valor_atualizado)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave = "UPDATE indicadores SET nome = :valor_atualizado WHERE id_indicador = :id_indicador";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":valor_atualizado", $valor_atualizado);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function atualizar_previsoes($id_inicial, $id_final, $valor_inicial, $valor_final)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave = "UPDATE previsoes SET nome_previsao_inicial =:valor_inicial, nome_previsao_final =:valor_final WHERE id_previsao_inicial = :id_inicial AND id_previsao_final = :id_final";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":valor_inicial", $valor_inicial);
    $stmt->bindParam(":valor_final", $valor_final);
    $stmt->bindParam(":id_inicial", $id_inicial);
    $stmt->bindParam(":id_final", $id_final);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    echo ("Valor inicial$valor_inicial valorfinal$valor_final id inicial$id_inicial id final$id_final$rgt");
    return ($rgt);
}
function atualizar_text_avaliativo($id_text_avaliativo, $valor_atualizado)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave = "UPDATE texto_avaliativo SET valor = :valor_atualizado WHERE id_texto_avaliativo = :id_texto_avaliativo";
    $stmt = $mysqli->prepare($chave);
    $stmt->bindParam(":valor_atual izado", $valor_atualizado);
    $stmt->bindParam(":id_texto_avaliativo", $id_text_avaliativo);
    // echo "SQL: $chave";

    $stmt->execute();
    $rgt = $stmt->rowCount();
    echo ("Valor inicial$valor_atualizado valorfinal$id_text_avaliativo FOIII: $rgt ");
    return ($rgt);
}
?>