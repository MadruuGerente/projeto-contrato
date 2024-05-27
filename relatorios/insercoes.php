<?php
require_once "..\bancodedados/bd_conectar.php";
$con = new Conexao();
$mysqli = $con->connect();
function verificaPrograma($programaId)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_sql_verificar = "SELECT COUNT(*) as total FROM programa WHERE id_programa=:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->bindParam(":id_programa",$programaId);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];

    return ($total > 0); // Retorna true se o programa existir, false caso contrário
}

function verificarMeta($metaid)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_sql_verificar = "SELECT COUNT(*) as total, tem_indicador FROM metas WHERE id_meta=:id_meta";
    $stmt = $mysqli->prepare($chave_sql_verificar);

    $stmt->bindParam(":id_meta", $metaid);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];
    $tem = $resultado['tem_indicador'];

    // Se desejar retornar 'true' para $tem se o valor for maior que zero, caso contrário, 'false'
    // $tem = ($tem > 0) ? true : false;

    $dados = array(
        'total' => $total,
        'tem' => $tem
    );
    return $dados;
}
function verificarIndicador($indicadorid)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_sql_verificar_indicador = "SELECT COUNT(*) as total FROM indicadores WHERE id_indicador=:id_indicador";
    $stmt = $mysqli->prepare($chave_sql_verificar_indicador);

    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];

    return ($total > 0);
}
function verificarPrevisoes($previsao_inicial, $previsao_final)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_sql_verificar_previsoes = "SELECT * FROM previsoes WHERE id_previsao_inicial=:id_previsao_inicial AND id_previsao_final=:id_previsao_final ";
    $stmt = $mysqli->prepare($chave_sql_verificar_previsoes);

    $stmt->bindParam(":id_previsao_inicial", $previsao_inicial);
    $stmt->bindParam(":id_previsao_final", $previsao_final);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function verificarTableaContratos($id_tabela_total)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_contratos = "SELECT * FROM tb_contratos WHERE id_tabela=:id_tabela";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);

    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function verificaTabelaPrevisoes($id_tabela_previsoes)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_previsoes = "SELECT * FROM tb_previsoes WHERE id_tabela=:id_tabela";
    $stmt = $mysqli->prepare($chave_verificar_tb_previsoes);

    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function verificaTextoAvaliativo($id_texto_avaliativo)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_texto_avaliativo = "SELECT * FROM texto_avaliativo WHERE id_texto_avaliativo=:id_texto_avaliativo";
    $stmt = $mysqli->prepare($chave_verificar_texto_avaliativo);

    $stmt->bindParam(":id_texto_avaliativo", $id_texto_avaliativo);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function verficaDadosPreistos($id_tabela_previsoes, $array_timestre)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_contratos = "SELECT * FROM previstos_no_trimestre WHERE id_tabela=:id_tabela AND bimestre_trimestre = :bimestre_trimestre";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);

    $stmt->execute();
    $rgt = $stmt->rowCount();

    return $rgt;
}
function verificaDadosRealizados($id_tabela_previsoes, $array_timestre)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_contratos = "SELECT * FROM realizados_no_trimestre WHERE id_tabela=:id_tabela AND bimestre_trimestre = :bimestre_trimestre";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);

    $stmt->execute();
    $rgt = $stmt->rowCount();

    return $rgt;
}
function verificaTotalPorAno($id_tabela_total, $ano)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_contratos = "SELECT * FROM total_por_ano WHERE id_tabela=:id_tabela AND ano = :ano";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":ano", $ano);

    $stmt->execute();
    $rgt = $stmt->rowCount();

    return $rgt;
}
function verificaDadosExecutados($id_tabela_total, $ano)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_verificar_tb_contratos = "SELECT * FROM total_executados WHERE id_tabela=:id_tabela AND ano = :ano";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":ano", $ano);

    $stmt->execute();
    $rgt = $stmt->rowCount();

    return $rgt;
}

function inserirPrograma($programaId,$cpf_criador, $programaValor, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    // Verifica se o programa já existe
    $verificar = verificaPrograma($programaId);
    if ($verificar > 0) {

        $chave_update_programa = "UPDATE programa SET nome_programa = :nome, data_criada = :data_criada WHERE id_programa = :id_programa";
        $stmt = $mysqli->prepare($chave_update_programa);
        $stmt->bindParam(":nome", $programaValor);
        $stmt->bindParam(":data_criada", $data);
        $stmt->bindParam(":id_programa", $programaId);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        echo ("TSTANDO OOOOO O O O O O O OO $rgt");
        return (1);
    } elseif ($verificar == 0) {
        echo ("TSTANDO OOOOO O O O O O O OO  ");
        $chave_inserir_programa = "INSERT INTO programa(id_programa, nome_programa, cpf_criador, data_criada) VALUES(:id_programa,:nome,:cpf_criador,:data_criada)";
        $stmt = $mysqli->prepare($chave_inserir_programa);
        $stmt->bindParam(":id_programa", $programaId);
        $stmt->bindParam(":nome", $programaValor);
        $stmt->bindParam(":cpf_criador", $cpf_criador);
        $stmt->bindParam(":data_criada", $data);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        return ($rgt);
    }

}
function inserirMeta($programaId, $metaid, $metavalor, $tem_indicador, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificarMeta($metaid);
    echo ("TOTALLLL $verifica[total]");

    if ($verifica['total'] > 0) {
        echo ("TOTALLLL $verifica[total]");
        if ($verifica['tem'] > 0) {
            echo ("TEM INDICADOR $verifica[tem]");
            $chave_update_meta = "UPDATE metas SET nome_meta = :nome, dt_criada = :data_criada WHERE id_meta = :id_meta";
            $stmt = $mysqli->prepare($chave_update_meta);
            $stmt->bindParam(":nome", $metavalor);
            // $stmt->bindParam(":tem_indicador", $tem_indicador);
            $stmt->bindParam(":data_criada", $data);
            $stmt->bindParam(":id_meta", $metaid);
            $stmt->execute();
            $rgt = $stmt->rowCount();
            return 1;
        } else {
            echo ("NÃO TEM  INDICADOR $verifica[tem]");
            $chave_update_meta = "UPDATE metas SET nome_meta = :nome, dt_criada = :data_criada, tem_indicador=:tem_indicador WHERE id_meta = :id_meta";
            $stmt = $mysqli->prepare($chave_update_meta);
            $stmt->bindParam(":nome", $metavalor);
            $stmt->bindParam(":tem_indicador", $tem_indicador);
            $stmt->bindParam(":data_criada", $data);
            $stmt->bindParam(":id_meta", $metaid);
            $stmt->execute();
            $rgt = $stmt->rowCount();
            return $rgt;
        }
    } elseif ($verifica['total'] == 0) {
        $chave_inserir_meta = "INSERT INTO metas(id_programa, id_meta, nome_meta,tem_indicador,dt_criada) VALUES(:id_programa,:id_meta,:nome,:tem_indicador,:data_criada)";
        $stmt = $mysqli->prepare($chave_inserir_meta);
        $stmt->bindParam(":id_programa", $programaId);
        $stmt->bindParam(":id_meta", $metaid);
        $stmt->bindParam(":nome", $metavalor);
        $stmt->bindParam(":tem_indicador", $tem_indicador);
        $stmt->bindParam(":data_criada", $data);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return ($rgt);
    }
}
function inserirIndicador($metaid, $indicadorid, $indicadorValor, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificarIndicador($indicadorid);
    if ($verifica > 0) {
        $chave_update_indicador = "UPDATE indicadores SET nome = :nome, dt_criada = :data_criada WHERE id_indicador = :id_indicador";
        $stmt = $mysqli->prepare($chave_update_indicador);
        $stmt->bindParam(":nome", $indicadorValor);
        $stmt->bindParam(":data_criada", $data);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return $rgt;
    } elseif ($verifica == 0) {
        $chave_inserir_indicador = "INSERT INTO indicadores(id_meta, id_indicador, nome,dt_criada) VALUES(:id_meta,:id_indicador,:nome,:data_criada)";
        $stmt = $mysqli->prepare($chave_inserir_indicador);
        $stmt->bindParam(":id_meta", $metaid);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":nome", $indicadorValor);
        $stmt->bindParam(":data_criada", $data);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        return ($rgt);
    }
}
function inserirPrevisoes($indicadorid, $previsao_inicial, $previsao_final, $valorinicial, $valorfinal, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificarPrevisoes($previsao_inicial, $previsao_final);
    if ($verifica > 0) {
        $chave_update_previsoes = "UPDATE previsoes SET nome_previsao_inicial = :nome_previsao_inicial, nome_previsao_final = :nome_previsao_final, dt_criada = :data_criada WHERE id_indicador = :id_indicador AND id_previsao_inicial = :id_previsao_inicial AND id_previsao_final = :id_previsao_final";
        $stmt = $mysqli->prepare($chave_update_previsoes);
        $stmt->bindParam(":nome_previsao_inicial", $valorinicial);
        $stmt->bindParam(":nome_previsao_final", $valorfinal);
        $stmt->bindParam(":data_criada", $data);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":id_previsao_inicial", $previsao_inicial);
        $stmt->bindParam(":id_previsao_final", $previsao_final);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        echo ("FOIII MANO");
        return $rgt;
    } else {
        $chave_inserir_previsoes = "INSERT INTO previsoes(id_indicador,id_previsao_inicial,id_previsao_final,nome_previsao_inicial,nome_previsao_final,dt_criada)
    VALUES(:id_indicador,:id_previsao_inicial,:id_previsao_final,:nome_previsao_inicial,:nome_previsao_final,:data_criada)";
        $stmt = $mysqli->prepare($chave_inserir_previsoes);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":id_previsao_inicial", $previsao_inicial);
        $stmt->bindParam(":id_previsao_final", $previsao_final);
        $stmt->bindParam(":nome_previsao_inicial", $valorinicial);
        $stmt->bindParam(":nome_previsao_final", $valorfinal);
        $stmt->bindParam(":data_criada", $data);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        echo ("NAO FOIII MANO");
        return ($rgt);
    }
}
function inserirTableaContratos($indicadorid, $id_tabela_total, $total_contratos, $total_executados, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificarTableaContratos($id_tabela_total);
    if ($verifica > 0) {
        $chave_update_tabela_contratos = "UPDATE tb_contratos SET total_contratos = :total_contratos, total_executados = :total_executados, dt_criada = :data_criada WHERE id_indicador = :id_indicador AND id_tabela = :id_tabela";
        $stmt = $mysqli->prepare($chave_update_tabela_contratos);
        $stmt->bindParam(":total_contratos", $total_contratos);
        $stmt->bindParam(":total_executados", $total_executados);
        $stmt->bindParam(":data_criada", $data);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":id_tabela", $id_tabela_total);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        return $rgt;
    }
    $chave_inserir_tabela_contratos = "INSERT INTO tb_contratos(id_indicador,id_tabela,total_contratos,total_executados,dt_criada)
    VALUES(:id_indicador,:id_tabela,:total_contratos,:total_executados,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_tabela_contratos);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":total_contratos", $total_contratos);
    $stmt->bindParam(":total_executados", $total_executados);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);
}
function inserirDadosContratos($id_tabela_total, $elementos_total_por_ano, $ano)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificaTotalPorAno($id_tabela_total, $ano);
    if ($verifica == 1) {
        $chave_update_total_por_ano = "UPDATE total_por_ano SET valor = :valor WHERE id_tabela = :id_tabela AND ano = :ano";
        $stmt = $mysqli->prepare($chave_update_total_por_ano);
        $stmt->bindParam(":valor", $elementos_total_por_ano);
        $stmt->bindParam(":id_tabela", $id_tabela_total);
        $stmt->bindParam(":ano", $ano);
        $stmt->execute();

        $rgt = $stmt->rowCount();
        return $rgt;
    }
    echo ("manooooooooooo $verifica");
    $chave_inserir_total_por_ano = "INSERT INTO total_por_ano(id_tabela,valor,ano) VALUES(:id_tabela,:valor,:ano)";
    $stmt = $mysqli->prepare($chave_inserir_total_por_ano);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":valor", $elementos_total_por_ano);
    $stmt->bindParam(":ano", $ano);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);

}
function inserirDadosExecutados($id_tabela_total, $elementos_executado_por_ano, $ano)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificaDadosExecutados($id_tabela_total, $ano);
    if ($verifica > 0) {
        $chave_update_total_executados = "UPDATE total_executados SET valor = :valor WHERE id_tabela = :id_tabela AND ano = :ano";
        $stmt = $mysqli->prepare($chave_update_total_executados);
        $stmt->bindParam(":valor", $elementos_executado_por_ano);
        $stmt->bindParam(":id_tabela", $id_tabela_total);
        $stmt->bindParam(":ano", $ano);
        $stmt->execute();

        $rgt = $stmt->rowCount();

        return $rgt;
    }
    $chave_inserir_total_por_ano = "INSERT INTO total_executados(id_tabela,valor,ano) VALUES(:id_tabela,:valor,:ano)";
    $stmt = $mysqli->prepare($chave_inserir_total_por_ano);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":valor", $elementos_executado_por_ano);
    $stmt->bindParam(":ano", $ano);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);

}
function inserirTableaPrevistos($indicadorid, $id_tabela_previsoes, $total_previstos, $total_realizados, $acumulativo, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificaTabelaPrevisoes($id_tabela_previsoes);

    if ($verifica > 0) {
        $chave_update_tabela_previsoes = "UPDATE tb_previsoes SET total_previstos = :total_previstos, total_realizados = :total_realizados, acumulativo = :acumulativo, dt_criada = :data_criada WHERE id_indicador = :id_indicador AND id_tabela = :id_tabela";
        $stmt = $mysqli->prepare($chave_update_tabela_previsoes);
        $stmt->bindParam(":total_previstos", $total_previstos);
        $stmt->bindParam(":total_realizados", $total_realizados);
        $stmt->bindParam(":acumulativo", $acumulativo);
        $stmt->bindParam(":data_criada", $data);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
        $stmt->execute();

        $rgt = $stmt->rowCount();

        return $rgt;
    }
    $chave_inserir_tabela_previsoes = "INSERT INTO tb_previsoes(id_indicador,id_tabela,total_previstos,total_realizados,acumulativo,dt_criada)
    VALUES(:id_indicador,:id_tabela,:total_previstos,:total_realizados,:acumulativo,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_tabela_previsoes);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":total_previstos", $total_previstos);
    $stmt->bindParam(":total_realizados", $total_realizados);
    $stmt->bindParam(":acumulativo", $acumulativo);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);
}
function inserirDadosPrevistos($id_tabela_previsoes, $elementos_previsto_trimestre, $array_timestre)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verficaDadosPreistos($id_tabela_previsoes, $array_timestre);
    if ($verifica == 1) {
        $chave_update_previsto_trimestre = "UPDATE previstos_no_trimestre SET valor = :valor WHERE id_tabela = :id_tabela AND bimestre_trimestre = :bimestre_trimestre";
        $stmt = $mysqli->prepare($chave_update_previsto_trimestre);
        $stmt->bindParam(":valor", $elementos_previsto_trimestre);
        $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
        $stmt->bindParam(":bimestre_trimestre", $array_timestre);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return $rgt;
    }
    $chave_inserir_previsto_trimestre = "INSERT INTO previstos_no_trimestre(id_tabela,valor,bimestre_trimestre) VALUES(:id_tabela,:valor,:bimestre_trimestre)";
    $stmt = $mysqli->prepare($chave_inserir_previsto_trimestre);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":valor", $elementos_previsto_trimestre);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);
}function inserirDadosRealizados($id_tabela_previsoes, $elementos_realizados_trimestre, $array_timestre)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificaDadosRealizados($id_tabela_previsoes, $array_timestre);
    if ($verifica == 1) {
        $chave_update_previsto_trimestre = "UPDATE realizados_no_trimestre SET valor = :valor WHERE id_tabela = :id_tabela AND bimestre_trimestre = :bimestre_trimestre";
        $stmt = $mysqli->prepare($chave_update_previsto_trimestre);
        $stmt->bindParam(":valor", $elementos_realizados_trimestre);
        $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
        $stmt->bindParam(":bimestre_trimestre", $array_timestre);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return $rgt;
    }
    $chave_inserir_realizados_trimestre = "INSERT INTO realizados_no_trimestre(id_tabela,valor,bimestre_trimestre) VALUES(:id_tabela,:valor,:bimestre_trimestre)";
    $stmt = $mysqli->prepare($chave_inserir_realizados_trimestre);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":valor", $elementos_realizados_trimestre);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return ($rgt);
}
function inserirTextoAvaliativo($indicadorid, $id_texto_avaliativo, $valor, $data)
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $verifica = verificaTextoAvaliativo($id_texto_avaliativo);
    if ($verifica > 0) {
        $chave_update_texto_avaliativo = "UPDATE texto_avaliativo SET valor = :valor WHERE id_indicador = :id_indicador AND id_texto_avaliativo = :id_texto_avaliativo";
        $stmt = $mysqli->prepare($chave_update_texto_avaliativo);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":id_indicador", $indicadorid);
        $stmt->bindParam(":id_texto_avaliativo", $id_texto_avaliativo);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return $rgt;
    }
    $chave_inserir_texto_avaliativo = "INSERT INTO texto_avaliativo(id_indicador,id_texto_avaliativo,valor,dt_criada) VALUES(:id_indicador,:id_texto_avaliativo,:valor,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_texto_avaliativo);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_texto_avaliativo", $id_texto_avaliativo);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
function deletePrograma($id_programa)
{
    $con = new Conexao();
    $mysqli = $con->connect();

    $chave_sql_verificar = "DELETE FROM programa WHERE id_programa=:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);

    $stmt->bindParam(":id_programa", $id_programa);
    $stmt->execute();

    $resultado = $stmt->rowCount();

    return $resultado;
}
function enviar_anexo($id_anexo, $caminho, $id_indicador, $nome,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_anexo = "INSERT INTO anexos(id_anexo,id_indicador,nome_anexo,caminho_anexo,dt_criada) VALUES(:id_anexo,:id_indicador,:nome_anexo,:caminho_anexo,:dt_criada)";
    $stmt = $mysqli->prepare($chave_inserir_anexo);
    $stmt->bindParam(":id_anexo", $id_anexo);
    $stmt->bindParam(":id_indicador", $id_indicador);
    $stmt->bindParam(":nome_anexo", $nome);
    $stmt->bindParam(":caminho_anexo", $caminho);
    $stmt->bindParam(":dt_criada", $data);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return ($rgt);
}
?>