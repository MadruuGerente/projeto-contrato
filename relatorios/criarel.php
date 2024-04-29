<script>

    function teste() {
        // Pega o formulário pelo ID
        const form = document.getElementById("formCriarRelatorio");
        console.log("este");

        // Objeto para armazenar os valores dos campos
        const dados = {};

        // Coletar valores de textareas
        const textareas = form.querySelectorAll("textarea");
        let cont_meta = 1;
        let cont_indicador = 1;
        
        textareas.forEach((textarea) => {
          
            console.log(textarea.id);    
            // let textareaa =;
            // let pro = "programa_";
            if (textarea.id.startsWith("programa")) {
                dados.programa_valor = textarea.value;
                dados.programa_id = textarea.id;
                console.log(dados.programa_valor);
                console.log(dados.programa_id);
            }else if(textarea.id.startsWith("meta")){
                let meta_cont = `meta_valor_${cont_meta}`;  
                let meta_cont_id = `meta_id_${cont_meta}`;

                dados[meta_cont] = textarea.value;
                dados[meta_cont_id] = textarea.id;
                console.log(meta_cont);
                console.log(dados.meta_cont_id);
                cont_meta ++;
                
            }else if(textarea.id.startsWith("indicador")){
                let indicador_cont = `indicador_valor_${cont_meta}${cont_indicador}`;  
                let indicador_cont_id = `indicador_id_${cont_meta}${cont_indicador}`;

                dados[indicador_cont] = textarea.value;
                dados[indicador_cont_id] = textarea.id;
                console.log(indicador_cont);
                console.log(dados.indicador_cont_id);
                cont_indicador ++;
            }
        });
        const tabela = form.querySelector("table"); // Pode ajustar para pegar a tabela certa
        const tbody = document.querySelector("tbody");
        const tr = tbody.querySelector("tr");
        const td = tr.querySelector("td");
      
        const inputs = tbody.querySelectorAll("tr > td > input"); // Ajustar o seletor para pegar inputs

        inputs.forEach((input) => {
            // console.log("Valor do input:", input.value);
            dados[input.valor] =  input.value;
            dados[input.id] =  input.id;
            // console.log("Valor do input:", input.value);
            // console.log("Valor do input:",  input.id);
            // console.log("Valor do input:", tabela.id);

             // Exibe o valor do input
        });
        console.log(dados);

            // const inputs = tr.querySelector("input");
        if (!inputs) {
            console.error("Tabela dentro do formulário não encontrada!");
            return null;
        }
        console.log("Tabela encontrada:", tabela);
        console.log("Tabela encontrada:", tbody);
        console.log("Tabela encontrada:", tr);
        console.log("Tabela encontrada:", td);

        console.log("Tabela encontrada:", inputs);
    
            }

// Retorna a tabela encontrada


// Exemplo para usar a função para pegar a tabela


        // // Coletar valores de inputs nas tabelas
        // const inputs = form.querySelectorAll("table tfoot td input");
        // inputs.forEach((input) => {
        //     if (input.name) {
        //         dados[input.name] = input.value;
        //         console.log(input.value)
        //     }
        // });
        // // Criar parâmetros para envio via POST
        // const params = new URLSearchParams(dados);

        // // Enviar dados para o PHP via fetch
        // fetch("atualizar_programa.php", {
        //     method: "POST",
        //     headers: {
        //         "Content-Type": "application/x-www-form-urlencoded",
        //     },
        //     body: params,
        // })
        //     .then((response) => response.text())
        //     .then((data) => {
        //         console.log("Resposta do servidor:", data);
        //     })
        //     .catch((error) => {
        //         console.error("Erro ao enviar dados:", error);
        //     });
    

    // // Associar a função ao evento de clique no botão
    // document.getElementById("atualizar").addEventListener("click", coletarEDados);


</script>
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
    //     // $dados_pegos .= "<img src='" . __DIR__ . "/imagens/logo.png'>";

    //     $dompdf->loadHtml($dados_pegos);

    //     $dompdf->setPaper('L', 'mm', 'A4', 'true', 'UTF-8', false);
//     // $dompdf->setPaper('A4', 'portrait');

    //     // Renderizar o PDF
//     $dompdf->render();

    //     // Obter o conteúdo do PDF como uma string
//     $pdf_content = $dompdf->output();
//     // $dompdf->stream('documento.pdf');
// // Iniciar a sessão e armazenar o conteúdo do PDF
//     $_SESSION['pdf_content'] = $pdf_content;

    //     // Redirecionar para a outra página
//     header("Location: exibir_pdf.php");
    exit();
    // Exibir o PDF

}
?>