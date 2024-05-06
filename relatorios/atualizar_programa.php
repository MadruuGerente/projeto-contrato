<?php
echo ("fhfghfd");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programa_valor = $_POST['programa_valor'] ?? "Nome não definido";
    $programa_id = $_POST['programa_id'] ?? "Nome não definido";
    echo "Nome: $programa_valor, Id: $programa_id ";

    if ($programa_id != null) {


        $meta_cont = 0;
        $indicador_cont = 0;
        do {
            $meta_cont++;
            $meta_valor = $_POST["meta_valor_$meta_cont"] ?? 0;
            $meta_id = $_POST["meta_id_$meta_cont"] ?? 0;
            if ($meta_valor != 0) {
                echo ("meta: $meta_valor\n");
                echo ("meta: $meta_id");
                do {
                    $indicador_cont++;
                    $indicador_valor = $_POST["indicador_valor_$meta_cont$indicador_cont"] ?? 0;
                    $indicador_id = $_POST["indicador_id_$meta_cont$indicador_cont"] ?? 0;
                    if ($indicador_valor != 0) {
                        echo ("$indicador_valor -- $indicador_id\n");
                        do {
                            $previsao_inicial_valor = $_POST["text_inicial_valor21"] ?? 0;
                            $previsao_inicial_id = $_POST["text_inicial_id$meta_cont$indicador_cont"] ?? 0;
                            
                            $indicador_id = $_POST["indicador_id_$meta_cont$indicador_cont"] ?? 0;
                            if ($previsao_inicial_valor != 0) {
                                echo ("$previsao_inicial_valor -- $previsao_inicial_id\n");
                            }

                        } while ($previsao_inicial_valor != 0);


                        
                    }

                } while ($indicador_valor != 0);

            }


        } while ($meta_valor != 0); // Continua enquanto o contador for menor que 5
    }


} else {
    echo "A solicitação não é POST.";
}
?>
