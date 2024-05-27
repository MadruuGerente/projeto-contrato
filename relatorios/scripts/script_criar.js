
let contPrograma = window.document.querySelector("input[name='id_do_programa']").value;

var funcaoChamada = false;

// contPrograma = contPrograma[contPrograma.length - 2];
contPrograma = contPrograma.substring(contPrograma.length - 8);
console.log(contPrograma);
window.addEventListener('beforeunload', function (event) {
    // Salvar os dados do formulário em localStorage'
    localStorage.setItem('campo1', document.querySelector(`#programa_${contPrograma}`).value);
    mandar("resetar");
});
let adicionar_meta = window.document.querySelector("#img_adicionar_meta");
let adicionar_indicador = window.document.querySelector("#img_adicionar_indicador");
let deletar_elemento = window.document.querySelector('#imd_deletar_utimo');
let jaexistente = window.document.querySelector(`#programa_${contPrograma}`);
let form = window.document.querySelector("#formCriarRelatorio");
let enviar = window.document.querySelector("#enviar");
let principal = window.document.querySelector("#principal");
const formData = new FormData(form);
// alert(contPrograma);

let guarda = 0;

let contMeta = 0;
let contIndicador = 0;
let contindicador2 = 1;
let contprevisao = 1;
let elementosCriados = [];
let dadosMetasIndicadores = [];
let primeirameta = 1;
let primeiroindicador = 1;
let ultimoElementoCriado = '';

function apagar_programa(quem_chama) {
    if (!funcaoChamada) {
        if (quem_chama == "enviar") {
            funcaoChamada = true;
            return "foii";
        } else {
            let id_programa = pegaProgram(); // Supondo que esta função retorne o ID do programa_
            const dados = new FormData();
            dados.append('pega_id_programa', id_programa['id']); // Passa o ID diretamente para o FormData
            // dados.append('contador', contIndicador);
            $.ajax({
                url: 'teste.php',
                method: 'POST',
                data: dados,
                processData: false,
                contentType: false,
                success: function (resposta) {
                    console.log(resposta);
                }
            });
            console.error(`olaaaa${id_programa}`);
        }
    }
}
function adicionarMeta() {

    criarNovaMeta();
    //atualizarVisualizacao();
}
function adicionarIndicador() {
    //let nomeIndicador = prompt("Digite o nome do indicador:");
    // apagar_programa();
    adicionarNovoIndicador();
    //atualizarVisualizacao();
}
function criarNovaMeta() {
    if (ultimoElementoCriado.tipo == 'indicador') {
        verdados("sai");
        console.log(ultimoElementoCriado);
        console.log("ERA PARA TER ENVIADO");
    } else {
        verdados("sao");
        console.log("num foi");
        console.log(ultimoElementoCriado);
    }
    contMeta++;
    let elementos_anexos = document.querySelectorAll("div[id^='div_anexo']");
    let elementos_total_contratos = document.querySelectorAll("div[id^='total_div']");
    let elementos_previsto_trimestre = document.querySelectorAll("div[id^='previsto_div']");
    //Pega os elementos que o id da div comçar com indicador
    let elementosIndicador = document.querySelectorAll("div[id^='indicadordiv']");
    //Pega os elementos que o id da div comçar com meta
    let elementosMeta = document.querySelectorAll("div[id^='metadiv']");
    //Cria uma div_meta
    let div_meta = document.createElement("div");
    div_meta.setAttribute('id', 'metadiv' + contMeta);
    div_meta.tipo = "meta";

    //Cria o label
    let novo_label = document.createElement("label");
    novo_label.textContent = "META " + contMeta;
    novo_label.setAttribute('id', 'metalabel' + contMeta);
    // Cria um textarea
    let novo_text = document.createElement("textarea");
    //Tira a propriedade do usuario pode mexer no tamanho dele
    novo_text.style.resize = "none";

    novo_text.setAttribute('id', 'meta_areatext' + contMeta + contPrograma);
    //Coloca o label e o textare dentro da div
    novo_label.setAttribute('for', novo_text.id);

    div_meta.appendChild(novo_label);
    div_meta.appendChild(novo_text);
    console.log('fff' + novo_text.id);
    //principal.appendChild(div_meta);
    console.log("Tipo do último elemento criado: " + ultimoElementoCriado.tipo);
    //Pega os ultimos lementos de cada função que foi criada
    ultimoIndicador = elementosIndicador[elementosIndicador.length - 1];
    ultimoMeta = elementosMeta[elementosMeta.length - 1];
    //if para posicionr tudo no lugar certo 
    if (elementosIndicador.length >= 1 && ultimoElementoCriado.tipo == 'indicador') {
        let ultimo_elemento_texto_avaliativo = elementos_anexos[elementos_anexos.length - 1];
        form.insertBefore(div_meta, ultimo_elemento_texto_avaliativo.nextSibling);
        console.log("PRIMEIRO IF");
        console.log("Tipo do último elemento criado: " + ultimoElementoCriado.tipo);
    } else if (elementosMeta.length >= 1 && ultimoElementoCriado == 'indicador') {

        form.insertBefore(div_meta, ultimoMeta.nextSibling);
        console.log("SEGUNDO");
    } else if (elementosMeta.length == 0) {
        // ultimoMeta=elementosMeta[elementosMeta.length -1];
        form.insertBefore(div_meta, jaexistente.nextSibling);
        console.log("TERCEIRO");
    } else {
        form.insertBefore(div_meta, ultimoMeta.nextSibling);
        console.log("QUARTO");
    }
    // Vê qual foi o tipo do ultimo elemento criado
    ultimoElementoCriado = { elemento: div_meta, tipo: "meta" };
    //Volta o contador do Indici de volta para 1

    let novaMeta = {
        tipo: "meta",
        label: "META " + contMeta,
        texto: novo_text.value,
        id: novo_text.id
    };
    dadosMetasIndicadores.push(novaMeta);

    contIndicador = 1;

    //acresenta mais um na meta 

}
function adicionarNovoIndicador() {

    let elementos_anexos = document.querySelectorAll("div[id^='div_anexo']");
    let elementos_previsto_trimestre = document.querySelectorAll("div[id^='previsto_div']");
    //Pega os elementos que o id da div comçar com indicador
    let elementosIndicador = document.querySelectorAll("div[id^='indicadordiv']");
    //Pega os elementos que o id da div comçar com indicador
    let elementosMeta = document.querySelectorAll("div[id^='metadiv']");

    //Cria div
    let div_indicador = document.createElement("div");
    div_indicador.id = "indicadordiv" + contPrograma + contMeta + contIndicador;

    div_indicador.tipo = "indicador";
    //Cria o label
    let novo_label = document.createElement("label");
    novo_label.textContent = "INDICADOR " + contIndicador;
    novo_label.id = "indicadorlabel" + contPrograma + contMeta + contIndicador; // Corrigir a lógica de atribuição de IDs
    //Cria o textarea
    let novo_text = window.document.createElement("textarea");
    novo_text.id = "indicadortextarea" + contPrograma + contMeta + contIndicador; // Corrigir a lógica de atribuição de IDs
    novo_text.style.resize = "none";

    novo_label.setAttribute('for', novo_text.id);
    div_indicador.appendChild(novo_label);
    div_indicador.appendChild(novo_text);
    // Acresenta um espaço de 20px a esquerda
    div_indicador.style.marginLeft = "20px";
    //ultimoElementoCriado = { elemento: div_indicador, tipo: "indicador" };
    //Ifs para organizar tudo 
    console.log("Tipo do último elemento criado: " + ultimoElementoCriado.tipo);
    if (primeiroindicador == 1) {
        ultimoMeta = elementosMeta[elementosMeta.length - 1];

        form.insertBefore(div_indicador, ultimoMeta.nextSibling);
        primeiroindicador++;
        console.log('PRIMEIRO');
    } else if (ultimoElementoCriado.tipo == 'meta') {
        ultimoMeta = elementosMeta[elementosMeta.length - 1];
        form.insertBefore(div_indicador, ultimoMeta.nextSibling);
        console.log('SEGUNDO');
    } else {
        let ultimo_elemento_texto_avaliativo = elementos_anexos[elementos_anexos.length - 1];
        form.insertBefore(div_indicador, ultimo_elemento_texto_avaliativo.nextSibling);
        console.log('TERCEIRO');
    }
    //acresenta no indicador

    let novoIndicador = {
        tipo: "indicador",
        label: "INDICADOR " + contIndicador,
        texto: novo_text.value,
        id: novo_text.id
    };
    dadosMetasIndicadores.push(novoIndicador);

    // vê qual foi o ultimo elemento criado
    ultimoElementoCriado = { elemento: div_indicador, tipo: "indicador" };
    criarPrevisao(contMeta, contIndicador);
    totalContratosPorAno(contMeta, contIndicador);
    previsto_no_trimestre(contMeta, contIndicador);
    textoAvaliativo(contMeta, contIndicador);
    botarAnexos(contMeta, contIndicador);
    contIndicador++;
}
function criarPrevisao(metaPertence, indicadorPertecente) {


    let elementosIndicador = document.querySelectorAll("div[id^='indicadordiv']");
    //Pega os elementos que o id da div comçar com indicador
    ultimoIndicadore = elementosIndicador[elementosIndicador.length - 1];

    let div_previsao = document.createElement('div');
    div_previsao.setAttribute('id', 'div_previsao' + contPrograma + metaPertence + indicadorPertecente);
    div_previsao.style.marginLeft = "40px";

    let text_previsao_inicial = document.createElement('textarea');
    text_previsao_inicial.setAttribute('id', 'text_previsao_inicial_' + contPrograma + metaPertence + indicadorPertecente);
    //text_previsao_inicial.style.height='20px';
    text_previsao_inicial.style.resize = "none";

    let text_previsao_final = document.createElement('textarea');
    text_previsao_final.setAttribute('id', 'text_previsao_final_' + contPrograma + metaPertence + indicadorPertecente);
    //text_previsao_final.style.height='20px';
    text_previsao_final.style.resize = "none";

    let label_previsao_inicial = document.createElement('label');
    label_previsao_inicial.setAttribute('id', 'label_previsao_inicial' + contPrograma + metaPertence + indicadorPertecente);
    label_previsao_inicial.textContent = 'Previsão inicial';
    //label_previsao_inicial.style.fontsize='12px';
    label_previsao_inicial.setAttribute('for', text_previsao_inicial.id);

    let label_previsao_final = document.createElement('label');
    label_previsao_final.textContent = 'Previsão final';
    label_previsao_final.setAttribute('id', 'label_previsao_final' + contPrograma + metaPertence + indicadorPertecente);
    //label_previsao_final.style.fontsize='12px';
    label_previsao_final.setAttribute('for', text_previsao_final.id);


    div_previsao.appendChild(label_previsao_inicial);
    div_previsao.appendChild(text_previsao_inicial);

    div_previsao.appendChild(label_previsao_final);
    div_previsao.appendChild(text_previsao_final);

    form.insertBefore(div_previsao, ultimoIndicadore.nextSibling);
}
function textoAvaliativo(metaPertence, indicadorPertecente) {

    const anoAtual = new Date().getFullYear();
    const doisUltimosDigitos = anoAtual % 100;


    let elementos_previsto_trimestre = document.querySelectorAll("div[id^='previsto_div']");
    let div_texto_avaliativo = document.createElement('div');
    div_texto_avaliativo.setAttribute('id', 'div_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente);
    div_texto_avaliativo.style.marginLeft = "40px";

    let text_texto_avaliativo1 = document.createElement('textarea');
    text_texto_avaliativo1.setAttribute('id', 'text_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 1);
    text_texto_avaliativo1.style.resize = "none";

    let label_texto_avaliativo1 = document.createElement('label');
    label_texto_avaliativo1.setAttribute('id', 'label_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 1);
    label_texto_avaliativo1.textContent = `Texto Avaliativo 1°Bimestre/${doisUltimosDigitos}`;
    label_texto_avaliativo1.setAttribute('for', text_texto_avaliativo1.id);

    let text_texto_avaliativo2 = document.createElement('textarea');
    text_texto_avaliativo2.setAttribute('id', 'text_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 2);
    text_texto_avaliativo2.style.resize = "none";

    let label_texto_avaliativo2 = document.createElement('label');
    label_texto_avaliativo2.setAttribute('id', 'label_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 2);
    label_texto_avaliativo2.textContent = `Texto Avaliativo 2° Trimestre/${doisUltimosDigitos}`;
    label_texto_avaliativo2.setAttribute('for', text_texto_avaliativo2.id);


    let text_texto_avaliativo3 = document.createElement('textarea');
    text_texto_avaliativo3.setAttribute('id', 'text_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 3);
    text_texto_avaliativo3.style.resize = "none";

    let label_texto_avaliativo3 = document.createElement('label');
    label_texto_avaliativo3.setAttribute('id', 'label_texto_avaliativo' + contPrograma + metaPertence + indicadorPertecente + 3);
    label_texto_avaliativo3.textContent = `Texto Avaliativo 3°Trimestre/${doisUltimosDigitos}`;
    label_texto_avaliativo3.setAttribute('for', text_texto_avaliativo3.id);

    div_texto_avaliativo.appendChild(label_texto_avaliativo1);
    div_texto_avaliativo.appendChild(text_texto_avaliativo1);

    div_texto_avaliativo.appendChild(label_texto_avaliativo2);
    div_texto_avaliativo.appendChild(text_texto_avaliativo2);

    div_texto_avaliativo.appendChild(label_texto_avaliativo3);
    div_texto_avaliativo.appendChild(text_texto_avaliativo3);

    ultima_previsao_criado = elementos_previsto_trimestre[elementos_previsto_trimestre.length - 1];

    form.insertBefore(div_texto_avaliativo, ultima_previsao_criado.nextSibling);
}
// function totalContratos(metaPertence, indicadorPertecente){
//     let elementos_previsao = document.querySelectorAll("div[id^='div_previsao']");

//     let div_total_contratos = document.createElement('div');
//     div_total_contratos.setAttribute('id', 'div_total_contratos' + metaPertence + indicadorPertecente);
//     div_total_contratos.style.marginLeft = "40px";

//     let text_total_contratos = document.createElement('textarea');
//     text_total_contratos.setAttribute('id','text_total_contratos');
//     text_total_contratos.style.resize= "none";

//     let label_total_contratos = document.createElement('label');
//     label_total_contratos.setAttribute('id', 'label_total_contratos' + metaPertence + indicadorPertecente);
//     label_total_contratos.textContent = "Total do contrato(s):";
//     label_total_contratos.setAttribute('for',text_total_contratos.id);

//     div_total_contratos.appendChild(label_total_contratos);
//     div_total_contratos.appendChild(text_total_contratos);

//     ultimoPrevisao = elementos_previsao[elementos_previsao.length -1];
//     form.insertBefore(div_total_contratos, ultimoPrevisao.nextSibling);

// }

// function sverdados(){ 

//     console.log('bora birls');
//     for (let i = 1; i <= contMeta; i++) {
//         let meta_id = 'meta_areatext' + i;
//         let meta_valor = document.querySelector(`#${meta_id}`).value;
//         console.log(`META ${i} ${meta_valor}`);

//         if(contIndicador > guarda){
//             guarda = contIndicador;
//         }

//         console.log(contIndicador);
//         console.log(guarda);
//         for (let j = 1; j <= guarda; j++) {

//             let id_indicador = 'indicadortextarea' + i + j;
//             let indicador_valor = document.querySelector(`#${id_indicador}`);

//             if (indicador_valor != null) {
//                 indicador_valor = indicador_valor.value;
//                 console.log(` INDICADOR ${i} ${j} ${indicador_valor}`);

//             // Ver previsão
//             let id_contprevisao_inicial = 'text_previsao_inicial' + i + j; 
//             let id_contprevisao_final = 'text_previsao_final' + i + j; 
//             let previsao_inicial = document.querySelector(`#${id_contprevisao_inicial}`);
//             let previsao_final = document.querySelector(`#${id_contprevisao_final}`);

//             if (previsao_inicial != null && previsao_final != null) {
//                 previsao_inicial = previsao_inicial.value;
//                 previsao_final = previsao_final.value;
//                 console.log(`  PREVISÃO INICIAL: ${previsao_inicial} ${i}${j}`);
//                 console.log(`  PREVISÃO FINAL: ${previsao_final} ${i}${j}`);
//             } else {
//                 console.log(`está vazio`);        
//             }
//             let id_tabela_total_por_ano = `totaltable${i}${j}`;
//             const tabela = document.getElementById(id_tabela_total_por_ano);
//             let dados = [];
//             let dadosExecutados = [];
//             let anos = [];
//             if (tabela) {
//                 let cabecalho = tabela.querySelector('thead.anos');
//                 if (cabecalho) {
//                     let primeiraLinhaCabecalho = cabecalho.querySelector('tr');
//                     let colunasCabecalho = primeiraLinhaCabecalho.querySelectorAll('th');

//                     // Iterando sobre as colunas do cabeçalho (começando do segundo índice para evitar a coluna vazia)
//                     for (let i = 0; i < colunasCabecalho.length; i++) {
//                         anos.push(colunasCabecalho[i].textContent.trim());
//                     }
//                 }

//                 // Obtendo as linhas da tabela
//                 let linhas = tabela.querySelectorAll('tbody tr');

//                 let linhaTotalExecutado = tabela.querySelector('tfoot.total-executado');
//                 let inputsExecutados = linhaTotalExecutado.querySelectorAll('td input');

//                 // Iterando sobre as linhas
//                 linhas.forEach((linha, rowIndex) => {
//                     let dadosLinha = [];

//                     // Obtendo todas as células da linha
//                     let celulas = linha.querySelectorAll('td');

//                     // Iterando sobre as células
//                     celulas.forEach((celula, colIndex) => {
//                         // Obtendo o valor do input na célula
//                         let valor = celula.querySelector('input').value;

//                         // Adicionando o valor ao array de dados da linha
//                         dadosLinha.push(valor);
//                     });

//                     // Adicionando o array de dados da linha ao array principal
//                     dados.push(dadosLinha);
//                 });

//                 // Verificando se há inputsExecutados antes de acessá-los
//                 if (inputsExecutados.length > 0) {
//                     inputsExecutados.forEach((inputExecutado) => {
//                         // Adicionando os valores ao array de dadosExecutados
//                         dadosExecutados.push(inputExecutado.value);
//                     });

//                     // Fazendo algo com o array de dadosExecutados
//                     console.log('Dados Executados por ano:', dadosExecutados);
//                     for(let p=0;p<dadosExecutados.length;p++){
//                         console.log('Dados Contratos por ano:', dadosExecutados[p]);
//                     }
//                 } else {
//                     console.error('Nenhum input encontrado dentro de tbody.total-executado.');
//                 }
//                 // Fazendo algo com o array de dados
//                 //console.log('Dados Contratos por ano:', dados);
//                 for(let p=0;p<dados.length;p++){
//                     console.log('Dados Contratos por ano:', dados[p]);
//                     console.log('Anos:', anos);
//                 }
//             } else {
//                 console.error('Tabela não encontrada.');
//             }
//         }
//     }
// }
// }

//FUNÇÕES PARA VER DADOS 
function verdados(enviado) {
    console.log('bora birls');

    for (let i = 1; i <= contMeta; i++) {
        const dados = new FormData();
        pega_meta = pegaMeta(i, contPrograma);
        console.log(pega_meta);

        let pegarElementosMeta = JSON.stringify(pegaMeta(i, contPrograma));
        let pegarPrograma = JSON.stringify(pegaProgram());

        dados.append('pegarElementosMeta', pegarElementosMeta);
        // dados.append('contador', contIndicador);
        dados.append('pegarPrograma', pegarPrograma);
        if (ultimoElementoCriado.tipo != 'indicador') {
            $.ajax({
                url: 'teste.php',
                method: 'POST',
                data: dados,
                processData: false,
                contentType: false,
                success: function (resposta) {
                    console.log(resposta);
                }
            });
        }
        if (contIndicador > guarda) {
            guarda = contIndicador;
        }
        console.log(`  CADEEEEEEEEEEEE ${guarda}`);
        if (guarda != 0) {
            console.error(`CADEEEEEEEEEEEE ${guarda}`);
            for (let j = 1; j <= guarda; j++) {
                if (pegaIndicador(i, j, contPrograma)) {
                    // console.error(`rodou ${j}`);
                    console.error("ESSSEEEEEE" + i, j, contIndicador);
                    console.log(pegaIndicador(i, j, contPrograma))
                    console.log(pegaPrevisao(i, j, contPrograma));
                    console.log(pegaElementosTabelaTotal(i, j, contPrograma));
                    console.log(pegarElementosTabelaPrevisoes(i, j, contPrograma));
                    console.log(pegarTextoAvaliativo(i, j, contPrograma));

                    let indicador = pegaIndicador(i, j, contPrograma);
                    let id_indicador = indicador['id'];

                    let pegarElementoInicialFinal = JSON.stringify(pegaPrevisao(i, j, contPrograma));
                    let pegarElementosPrevisoes = JSON.stringify(pegarElementosTabelaPrevisoes(i, j, contPrograma));
                    let pegarElementosTotal = JSON.stringify(pegaElementosTabelaTotal(i, j, contPrograma));
                    let pegarElementosTextoAvaliativo = JSON.stringify(pegarTextoAvaliativo(i, j, contPrograma));
                    let pegarElementosIndicador = JSON.stringify(pegaIndicador(i, j, contPrograma));


                    // console.log(pegarTextoAvaliativo(i, j, contPrograma));

                    dados.append('pegarElementosIndicador', pegarElementosIndicador);
                    dados.append('pegarElementoInicialFinal', pegarElementoInicialFinal);
                    dados.append('pegarElementosTotal', pegarElementosTotal);
                    dados.append('pegarElementosPrevisoes', pegarElementosPrevisoes);
                    dados.append('pegarElementosTextoAvaliativo', pegarElementosTextoAvaliativo);

                    $.ajax({
                        url: 'teste.php',
                        method: 'POST',
                        data: dados,
                        processData: false,
                        contentType: false,
                        success: function (resposta) {
                            console.log(resposta);
                            if (pegarAnexo(i, j, contPrograma, id_indicador) == "erro") {
                                erroAnexo();
                            } else {
                                if (enviado == "enviar") {
                                    abrirPagina();
                                }
                            }

                        }
                    });

                }
            }
        }
    }
}
function pegaProgram() {
    let id_programa = `programa_${contPrograma}`;
    let programa_ = window.document.querySelector(`#${id_programa}`);
    let valorPrograma = programa_.value;
    return {
        id: id_programa,
        valor: valorPrograma,
    }

}
function pegarTextoAvaliativo(i, j, contPrograma) {
    let objetoAvaliativo = {};
    let arrayIds = [];
    let arrayValor = [];

    const anoAtual = new Date().getFullYear();
    const doisUltimosDigitos = anoAtual % 100;

    for (cont = 1; cont <= 3; cont++) {
        let array = 0;
        let text = "°Bimestre";
        if (cont <= 1) {
            text = "°Bimestre";
        } else {
            text = "°Trimestre";
        }
        let id_texto_avaliativo = 'text_texto_avaliativo' + contPrograma + i + j + cont;
        let texto_avaliativo = document.querySelector(`#${id_texto_avaliativo}`);
        if (texto_avaliativo != null) {
            texto_avaliativo = texto_avaliativo.value;

            arrayIds.push(id_texto_avaliativo);
            arrayValor.push(texto_avaliativo);
            console.log(`id ${i}${j}${cont}: ${cont}${text}: ${texto_avaliativo}`);
        }
    }
    objetoAvaliativo['id'] = arrayIds;
    objetoAvaliativo['valor'] = arrayValor;
    return objetoAvaliativo;
}
function pegaMeta(i, contPrograma) {
    let meta_id = 'meta_areatext' + i + contPrograma;
    let meta_valor = document.querySelector(`#${meta_id}`);
    if (meta_valor != null) {
        meta_valor = meta_valor.value;
        return {
            valor: meta_valor,
            id: meta_id
        }
        console.log(`META ${i} ${meta_valor}`);
    }
}
function pegaIndicador(i, j, contPrograma) {

    let id_indicador = 'indicadortextarea' + contPrograma + i + j;
    let indicador_valor = document.querySelector(`#${id_indicador}`);
    if (indicador_valor != null) {
        indicador_valor = indicador_valor.value;
        return {
            valor: indicador_valor,
            id: id_indicador,

        }
    }
}
function pegaPrevisao(i, j, contPrograma) {
    let id_contprevisao_inicial = 'text_previsao_inicial_' + contPrograma + i + j;
    let id_contprevisao_final = 'text_previsao_final_' + contPrograma + i + j;
    let previsao_inicial = document.querySelector(`#${id_contprevisao_inicial}`);
    let previsao_final = document.querySelector(`#${id_contprevisao_final}`);
    if (previsao_inicial != null && previsao_final != null) {
        previsao_inicial = previsao_inicial.value;
        previsao_final = previsao_final.value;
        return {
            idinicial: `${id_contprevisao_inicial}`,
            idfinal: `${id_contprevisao_final}`,
            valorinicial: `${previsao_inicial}`,
            valorfinal: `${previsao_final}`
        }
        console.log(`  PREVISÃO INICIAL ${i}${j}: ${previsao_inicial} `);
        console.log(`  PREVISÃO FINAL ${i}${j}: ${previsao_final} `);
    } else {
        //console.log(`está vazio`);        
    }
}
function pegaElementosTabelaTotal(i, j, contPrograma) {
    let soma_contratos = 0;
    const cells = document.querySelectorAll('.total-por-ano input[type="text"]');
    cells.forEach(cell => {
        const valor = parseFloat(cell.value) || 0; // Converte o valor para um número, ou 0 se não for um número válido
        soma_contratos += valor;
    });
    let soma_executados = 0;
    const cellss = document.querySelectorAll('.total-executado input[type="text"]');
    cellss.forEach(cell => {
        const valor = parseFloat(cell.value) || 0; // Converte o valor para um número, ou 0 se não for um número válido
        soma_executados += valor;
    });
    let id_tabela_total_por_ano = `totaltable_${contPrograma}${i}${j}`;
    const tabela = document.getElementById(id_tabela_total_por_ano);
    let dados = [];
    let dadosExecutados = [];
    let anos = [];
    if (tabela != null) {
        let cabecalho = tabela.querySelector('thead.anos');
        if (cabecalho) {
            let primeiraLinhaCabecalho = cabecalho.querySelector('tr');
            let colunasCabecalho = primeiraLinhaCabecalho.querySelectorAll('th');

            // Iterando sobre as colunas do cabeçalho (começando do segundo índice para evitar a coluna vazia)
            for (let i = 0; i < colunasCabecalho.length; i++) {
                anos.push(colunasCabecalho[i].textContent.trim());
            }
        }

        // Obtendo as linhas da tabela
        let linhas = tabela.querySelectorAll('tbody tr');

        let linhaTotalExecutado = tabela.querySelector('tfoot.total-executado');
        let inputsExecutados = linhaTotalExecutado.querySelectorAll('td input');

        // Iterando sobre as linhas
        linhas.forEach((linha, rowIndex) => {
            let dadosLinha = [];

            // Obtendo todas as células da linha
            let celulas = linha.querySelectorAll('td');

            // Iterando sobre as células
            celulas.forEach((celula, colIndex) => {
                // Obtendo o valor do input na célula
                let valor = celula.querySelector('input').value;

                // Adicionando o valor ao array de dados da linha
                dadosLinha.push(valor);
            });

            // Adicionando o array de dados da linha ao array principal
            dados.push(dadosLinha);
        });

        // Verificando se há inputsExecutados antes de acessá-los
        if (inputsExecutados.length > 0) {
            inputsExecutados.forEach((inputExecutado) => {
                // Adicionando os valores ao array de dadosExecutados
                dadosExecutados.push(inputExecutado.value);
            });

            // Fazendo algo com o array de dadosExecutados
            console.log(`${id_tabela_total_por_ano}`);
            // console.log('Dados Executados por ano:', dadosExecutados);
            for (let p = 0; p < dadosExecutados.length; p++) {
                // console.log('  Dados Contratos por ano:', dadosExecutados[p]);
            }
        } else {
            console.error('Nenhum input encontrado dentro de tbody.total-executado.');
        }
        // Fazendo algo com o array de dados
        //console.log('Dados Contratos por ano:', dados);
        for (let p = 0; p < dados.length; p++) {
            // console.log('Dados Contratos por ano:', dados[p]);
            // console.log('Anos:', anos);
        }
        return {
            id: `${id_tabela_total_por_ano}`,
            dados_contratados: `${dados}`,
            dados_executados: `${dadosExecutados}`,
            dados_anos: `${anos}`,
            total_contratos: `${soma_contratos}`,
            total_executados: `${soma_executados}`
        }
    } else {
        //console.log('Tabela não encontrada.');
    }
}
function pegarElementosTabelaPrevisoes(i, j, contPrograma) {

    let soma_previstos = 0;
    const cells = document.querySelectorAll('.previsto input[type="text"]');
    cells.forEach(cell => {
        const valor = parseFloat(cell.value) || 0; // Converte o valor para um número, ou 0 se não for um número válido
        soma_previstos += valor;
    });

    let soma_realizados = 0;
    const cellss = document.querySelectorAll('.realizado input[type="text"]');

    // Itera sobre os elementos selecionados, ignorando o último
    for (let i = 0; i < cellss.length - 1; i++) {
        const cell = cellss[i];
        const valor = parseFloat(cell.value) || 0; // Converte o valor para um número, ou 0 se não for um número válido
        soma_realizados += valor;
    }

    console.log("A soma total dos valores realizados, exceto o último, é: " + soma_realizados);


    let id_tabela_previsoes = `previsto_table${contPrograma}${i}${j}`;
    let tabela_previsoes = document.querySelector(`#${id_tabela_previsoes}`);
    let dadosPrevistos = [];
    let dadosRealizados = [];
    let acumulativo = 0;
    if (tabela_previsoes) {
        let linhasPrevisto = tabela_previsoes.querySelectorAll('tbody.previsto tr');
        linhasPrevisto.forEach((linha, index) => {
            let dadosLinhaPrevisto = [];

            // Obtendo todas as células da linha
            let celulas = linha.querySelectorAll('td');

            // Iterando sobre as células
            celulas.forEach((celula, index) => {
                // Obtendo o valor do input na célula
                let valor = celula.querySelector('input');
                if (valor) {
                    valor = valor.value;
                }
                // Adicionando o valor ao array de dados da linha
                dadosLinhaPrevisto.push(valor);
            });

            // Adicionando o array de dados da linha ao array principal de previsto
            dadosPrevistos.push(dadosLinhaPrevisto);
        });

        // Obtendo as linhas de realizado
        let linhasRealizado = tabela_previsoes.querySelectorAll('tfoot.realizado tr');
        linhasRealizado.forEach((linha, index) => {
            let dadosLinhaRealizado = [];

            // Obtendo todas as células da linha
            let celulas = linha.querySelectorAll('td');

            // Iterando sobre as células
            celulas.forEach((celula, index) => {
                // Obtendo o valor do input na célula
                let valor = celula.querySelector('input');
                if (valor) {
                    valor = valor.value;
                }

                // Adicionando o valor ao array de dados da linha
                dadosLinhaRealizado.push(valor);
            });

            // Adicionando o array de dados da linha ao array principal de realizado
            dadosRealizados.push(dadosLinhaRealizado);
            acumulativo = dadosRealizados[dadosRealizados.length - 1];
            acumulativo = acumulativo[acumulativo.length - 1];
            console.error(acumulativo);

        });
        // console.log('Dados Previstos:', dadosPrevistos);
        // console.log('Dados Realizados:', dadosRealizados);
        console.log(id_tabela_previsoes);
        console.log(soma_previstos);
        return {
            id: `${id_tabela_previsoes}`,
            dados_previstos: `${dadosPrevistos}`,
            dados_realizados: `${dadosRealizados}`,
            soma_previstos: `${soma_previstos}`,
            soma_realizados: `${soma_realizados}`,
            acumulativo: acumulativo
        }
    } else {
        //console.log('dnow');
    }

}
function totalContratosPorAno(metaPertence, indicadorPertecente) {
    // Número de anos
    let elementos_previsao = document.querySelectorAll("div[id^='div_previsao']");
    let div_total_contratos_por_ano = document.createElement('div');
    div_total_contratos_por_ano.setAttribute('id', 'total_div' + contPrograma + metaPertence + indicadorPertecente);

    let label_total_contratos_por_ano = document.createElement('label');
    label_total_contratos_por_ano.setAttribute('id', 'total_label' + contPrograma + metaPertence + indicadorPertecente);
    label_total_contratos_por_ano.textContent = "Total de contratos por ano:";

    const hoje = new Date();  // Obtém a data atual
    const anoAtual = hoje.getFullYear();  // Obtém o ano atual
    // Gera os próximos seis anos
    const anos = Array.from({ length: 6 }, (_, index) => anoAtual + index);

    // Criar a tabela
    const tabela_total_contratos_por_ano = document.createElement('table');
    tabela_total_contratos_por_ano.setAttribute('id', 'totaltable_' + contPrograma + metaPertence + indicadorPertecente);
    // tabela_total_contratos_por_ano.innerHTML = `<thead><tr>${anos.map(ano => `<th>${ano}</th>`).join('')}</tr></thead>`;
    // tabela_total_contratos_por_ano.innerHTML += `<tbody><tr>${anos.map(() => '<td id=totalCtd${metaPertence}><input type="text" placeholder="0"></td>').join('')}</tr></tbody>`;
    // tabela_total_contratos_por_ano.innerHTML += `<tbdoy><tr>${anos.map(() => '<td id="totalEtd${index}"><input type="text" placeholder="-"></td>').join('')}</tr></tbody>`;
    tabela_total_contratos_por_ano.innerHTML = `<thead class="anos">
    <tr>
      <td></td>
      ${anos.map(ano => `<th>${ano}</th>`).join('')}
    </tr>
  </thead>
  <tbody class="total-por-ano">
    <tr>
      <th>Total por ano</th>
      ${anos.map(() => '<td><input type="number" placeholder="0"></td>').join('')}
    </tr>   
  </tbody>
  <tfoot class="total-executado">
    <tr>
      <th>Total executado(ano)</th>
      ${anos.map(() => '<td><input type="number" placeholder="-"></td>').join('')}
    </tr>
  </tfoot>`;

    // Adicionar a tabela ao corpo do documento
    ///document.body.appendChild(tabela);
    div_total_contratos_por_ano.appendChild(label_total_contratos_por_ano);
    div_total_contratos_por_ano.appendChild(tabela_total_contratos_por_ano);
    div_total_contratos_por_ano.style.marginLeft = "40px";
    ultimoPrevisao = elementos_previsao[elementos_previsao.length - 1];
    form.insertBefore(div_total_contratos_por_ano, ultimoPrevisao.nextSibling);
}
function previsto_no_trimestre(metaPertence, indicadorPertecente) {
    let elementos_total_contratos = document.querySelectorAll("div[id^='total_div']");
    let array_timestre = [];
    let b_out_t = '°Trim';
    for (let i = 1; i <= 4; i++) {
        b_out_t = '°Trim';
        if (i == 1) {
            b_out_t = '°Bim';
        }
        array_timestre[i] = `${i}${b_out_t}`;
        console.log(array_timestre[i]);
    }
    let div_previsto_no_trimestre = document.createElement('div');
    div_previsto_no_trimestre.setAttribute('id', 'previsto_div' + contPrograma + metaPertence + indicadorPertecente);

    let label_previsto_no_trimestre = document.createElement('label');
    label_previsto_no_trimestre.setAttribute('id', 'previsto' + contPrograma + metaPertence + indicadorPertecente);
    label_previsto_no_trimestre.textContent = 'Previsões e realizadas:';

    let tabela_previsto_no_trimestre = document.createElement('table');
    tabela_previsto_no_trimestre.setAttribute('id', 'previsto_table' + contPrograma + metaPertence + indicadorPertecente);
    tabela_previsto_no_trimestre.innerHTML = `<thead>
    <tr>
        <td></td>
        ${array_timestre.map(array => `<th>${array}</th>`).join('')}
        <th>Acum.</th>
    </tr>
</thead>
<tbody class="previsto">
    <tr>
        <th>Previsto no trimestre</th>
        ${array_timestre.map(() => '<td><input type="number" placeholder="0"></td>').join('')}
        <td></td>
    </tr>
</tbody>
<tfoot class="realizado">
    <tr>
        <th>Realizado no trimestre</th>
        ${array_timestre.map(() => '<td><input type="number" placeholder="0"></td>').join('')}
        <td><input type="number" placeholder="0"></td>
    </tr>
</tfoot>`;

    div_previsto_no_trimestre.appendChild(label_previsto_no_trimestre);
    div_previsto_no_trimestre.appendChild(tabela_previsto_no_trimestre);
    div_previsto_no_trimestre.style.marginLeft = "40px";
    ultimo_total_contratos = elementos_total_contratos[elementos_total_contratos.length - 1];
    form.insertBefore(div_previsto_no_trimestre, ultimo_total_contratos.nextSibling);
}
function teste() {
    const dados = new FormData();
    dados.append('teste', 'bora mn');
    dados.append('face', 'rosto');
    dados.append('nome', 'Rafael');

    $.ajax({
        url: 'teste.php',
        method: 'POST',
        data: dados,
        processData: false,
        contentType: false,
        success: function (resposta) {
            console.log(resposta);
        }
    });
}
function abrirPagina() {
    window.location.href = "relatorios.php";
}
function voltar() {
    abrirPagina();
}
function mandar(quem) {
    verdados(quem);
    apagar_programa(quem);
}
function botarAnexos(contMeta, contIndicador) {
    let elementos_texto_avaliativo = document.querySelectorAll("div[id^='div_texto_avaliativo']");
    //Cria div
    let div_anexo = document.createElement("div");
    div_anexo.id = "div_anexo" + contPrograma + contMeta + contIndicador;
    div_anexo.style.marginLeft = "40px";


    //Cria o label
    let labelanexo = document.createElement("label");
    labelanexo.textContent = "anexo";
    labelanexo.id = "anexolabel" + contPrograma + contMeta + contIndicador; // Corrigir a lógica de atribuição de IDs
    //Cria o textarea
    let inputanexo = window.document.createElement("input");
    inputanexo.id = "anexoinput" + contPrograma + contMeta + contIndicador; // Corrigir a lógica de atribuição de IDs
    inputanexo.type = "file";
    inputanexo.multiple = true;
    //   novo_text.style.resize = "none";

    div_anexo.appendChild(labelanexo);
    div_anexo.appendChild(inputanexo);

    let ultimo_elemento_texto_avaliativo = elementos_texto_avaliativo[elementos_texto_avaliativo.length - 1];

    form.insertBefore(div_anexo, ultimo_elemento_texto_avaliativo.nextSibling);

}
function pegarAnexo(i, j, contPrograma, id_indicador) {
    let id_anexo = 'anexoinput' + contPrograma + i + j;
    let anexo = document.querySelector(`#${id_anexo}`);

    if (anexo != null) {
        for (let a = 0; a < anexo.files.length; a++) {
            id_anexo_id = `${id_anexo}${a}`;
            id_indicadorr = id_indicador;
            let formData = new FormData();
            let anexo_ = anexo.files[a];
            let tipo = anexo_.name.split('.').pop().toLowerCase();
            if (tipo == "pdf" || tipo == "jpg" || tipo == "png" || tipo == "mp4" || tipo == "jpeg") {
                formData.append("anexo", anexo_);
                formData.append("id", id_anexo_id);
                formData.append("id_indicador", id_indicadorr);

                $.ajax({
                    url: 'teste.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (resposta) {
                        console.log(resposta);
                        console.log(pegaIndicador(i, j, contPrograma));
                        console.log(i, j, contIndicador);
                        // return "foii";
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                return "erro";
            }
        };

    } else {
        // Retorna uma mensagem de erro
        return {
            error: "Elemento não encontrado",
            id: id_anexo
        };
    }
}
function erroAnexo() {
    Swal.fire({
        icon: "error",
        title: "Oops... anexos não permitidos",
        text: "PERMITIDOS: JPG, PNG, PDF,ETC!",
        // footer: '<a href="#">Why do I have this issue?</a>'
    });
}

// Chamar a função para criar a tabela
adicionar_meta.addEventListener('click', adicionarMeta);
adicionar_indicador.addEventListener('click', adicionarIndicador);
// enviar.addEventListener('click', mandar);
enviar.addEventListener('click', function (event) {
    mandar("enviar");
});
//enviar.addEventListener('click', abrirPagina);


