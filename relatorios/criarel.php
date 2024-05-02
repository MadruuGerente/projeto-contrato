<script>

    function teste() {
        // Pega o formulário pelo ID
        const form = document.getElementById("formCriarRelatorio");
        console.log("este");

        // Objeto para armazenar os valores dos campos
        const dados = {};

        // Coletar valores de textareas
        const textareas = form.querySelectorAll("textarea");
        const tabela_total = form.querySelectorAll("table");

        let cont_meta = 1;
        let cont_indicador = 1;
      
        textareas.forEach((textarea) => {
          
            console.log(textarea.id);    
            // const textareaa =;
            // const pro = "programa_";
            if (textarea.id.startsWith("programa")) {
                dados.programa_valor = textarea.value;
                dados.programa_id = textarea.id;
                console.log(dados.programa_valor);
                console.log(dados.programa_id);
            }else if(textarea.id.startsWith("meta")){
                const meta_valor = `meta_valor_${cont_meta}`;  
                const meta_cont_id = `meta_id_${cont_meta}`;

                dados[meta_valor] = textarea.value;
                dados[meta_cont_id] = textarea.id;
                console.log(meta_valor);
                console.log(dados[meta_cont_id]);
                cont_meta ++;
            }else if(textarea.id.startsWith("indicador")){
                const indicador_valor = `indicador_valor_${cont_meta -1}${cont_indicador}`;  
                const indicador_cont_id = `indicador_id_${cont_meta -1}${cont_indicador}`;

                dados[indicador_valor] = textarea.value;
                dados[indicador_cont_id] = textarea.id;
                console.log(dados[indicador_valor]);
                console.log(dados[indicador_cont_id]);
                cont_indicador ++;
            }else if(textarea.id.startsWith("text_previsao_inicial_")){
                const text_inicial_valor = `text_inicial_valor${cont_meta -1}${cont_indicador -1}`;
                const text_inicial_cont_id = `text_inicial_cont_id${cont_meta -1}${cont_indicador -1}`;

                dados[text_inicial_valor] =textarea.value;
                dados[text_inicial_cont_id] = textarea.id;

                console.log( dados[text_inicial_valor] );
                console.log( dados[text_inicial_cont_id]);
            }else if(textarea.id.startsWith("text_previsao_final_")){
                const text_final_valor = `text_final_valor${cont_meta -1}${cont_indicador -1}`;
                const text_final_cont_id = `text_final_cont_id${cont_meta -1}${cont_indicador -1}`;

                dados[text_final_valor] =textarea.value;
                dados[text_final_cont_id] = textarea.id;

                console.log( dados[text_final_valor] );
                console.log( dados[text_final_cont_id]);
            }else if(tabela_total != null){
                

            }
        });
        let dados_total = [];
                let ids_total = [];
                let ids_executados = [];
                let dadosExecutados =[];
                let passa = 0;
                for (let i = 0; i < tabela_total.length; i++) {
                    console.error(tabela_total.length);
                    const tabela = tabela_total[i]; 
                    if(tabela.id.startsWith("totaltable")){
                        let linhas = tabela.querySelectorAll('tbody tr');

                        let linhaTotalExecutado = tabela.querySelector('tfoot.total-executado');
                        let inputsExecutados = linhaTotalExecutado.querySelectorAll('td input');

                        // Iterando sobre as linhas
                        linhas.forEach((linha, rowIndex) => {
                            let dadosLinha = [];
                            let dadosLinhas = [];


                            // Obtendo todas as células da linha
                            let celulas = linha.querySelectorAll('td');

                            // Iterando sobre as células
                            celulas.forEach((celula, colIndex) => {
                                // Obtendo o valor do input na célula
                                let valor = celula.querySelector('input').value;
                                let valor_id = celula.querySelector('input').id;


                                // Adicionando o valor ao array de dados da linha
                                dadosLinha.push(valor);
                                dadosLinhas.push(valor_id);

                            });

                            // Adicionando o array de dados da linha ao array principal
                            dados_total.push(dadosLinha);
                            ids_total.push(dadosLinhas);
                        });

                        // Verificando se há inputsExecutados antes de acessá-los
                        if (inputsExecutados.length > 0) {
                            inputsExecutados.forEach((inputExecutado) => {
                                // Adicionando os valores ao array de dadosExecutados
                                dadosExecutados.push(inputExecutado.value);
                                ids_executados.push(inputExecutado.id);

                            }); 

                            // Fazendo algo com o array de dadosExecutados
                            // console.log(`${id_tabela_total_por_ano}`);
                            console.log('Dados Executados por ano:', ids_executados);
                            console.log('Dados Executados por ano:', ids_total);

                            console.log('Dados Executados por ano:', dadosExecutados.length);
                            console.log('Dados Executados por ano:', dados_total);
                            let id_labela_total = `id_labela_total${cont_meta -1}${cont_indicador -1}`; 
                            
                            let t = dados_total[0];
                            let id_total =ids_total[0];
                            
                            for (let p = 0; p < dadosExecutados.length; p++) {
                                let valor_total = `valor_total${p+1}${cont_indicador-1}`;
                                let valor_total_id = `valor_total_id${p+1}${cont_indicador-1}`;

                                let valor_executado = `valor_executado${p+1}${cont_indicador-1}`
                                let valor_executado_id = `valor_executado_id${p+1}${cont_indicador-1}`

                                    dados[valor_total] = t[p];
                                dados[valor_total_id] = id_total[p];

                                    dados[valor_executado] = dadosExecutados[p];
                                    dados[valor_executado_id] = ids_executados[p];

                                    console.error('Dados executados por ano:', dadosExecutados[p] , ids_executados[p]);
                                    console.error('Dados Contratos por ano:', t[p], id_total[p]);

                                // console.error('valor', dados_total.length);
                            }
                        } else {
                            console.error('Nenhum input encontrado dentro de tbody.total-executado.');
                        }
                        // Fazendo algo com o array de dados
                        //console.log('Dados Contratos por ano:', dados);
                        for (let p = 0; p < dados_total.length; p++) {
                            console.log('Dados Contratos por ano:', dados_total[p]);
                            // console.log('Anos:', anos);
                        }
                    
                    }
                    passa = 1;
                }; 
        // const tabela_id = form.querySelector("table"); // Pode ajustar para pegar a tabela certa

        // const tbody = document.querySelector("tbody");
        // const tr = tbody.querySelector("tr");
        // const td = tr.querySelector("td");
      
        // const inputs = tbody.querySelectorAll("tr > td > input"); // Ajustar o seletor para pegar inputs

        // inputs.forEach((input) => {
        //     // console.log("Valor do input:", input.value);
        //     dados[input.valor] =  input.value;
        //     dados[input.id] =  input.id;
        //     // console.log("Valor do input:", input.value);
        //     // console.log("Valor do input:",  input.id);
        //     // console.log("Valor do input:", tabela.id);

        //      // Exibe o valor do input
        // });
        console.log(dados);

        //     const inputss = tr.querySelector("input");
        // if (!inputss) {
        //     console.error("Tabela dentro do formulário não encontrada!");
        //     return null;
        // }
        // // console.log("Tabela encontrada:", tabela);
        // console.log("Tabela encontrada:", tbody);
        // console.log("Tabela encontrada:", tr);
        // console.log("Tabela encontrada:", td);

        // console.log("Tabela encontrada:", inputs);
    
            }

// Retorna a tabela encontrada


// Exemplo para usar a função para pegar a tabela


        // // Coletar valores de inputs nas tabela_total
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
// session_start();
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