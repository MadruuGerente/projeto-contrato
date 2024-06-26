function recuperar_informações() {
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
    let cont_text_avaliativo = 1;
    let tt = 0;
    textareas.forEach((textarea) => {

        console.log(textarea.id);

        // const textareaa =;
        // const pro = "programa_";
        if (textarea.id.startsWith("programa")) {
            dados["programa_valor"] = textarea.value;
            dados["programa_id"] = textarea.id;
            // console.log(dados.programa_valor);
            // console.log(dados.programa_id);
        } else if (textarea.id.startsWith("meta")) {
            const meta_valor = `meta_valor_${cont_meta}`;
            const meta_cont_id = `meta_id_${cont_meta}`;

            dados[meta_valor] = textarea.value;
            dados[meta_cont_id] = textarea.id;
            console.log(meta_valor);
            console.log(dados[meta_cont_id]);
            cont_meta++;
        } else if (textarea.id.startsWith("indicador")) {
            const indicador_valor = `indicador_valor_${cont_meta - 1}${cont_indicador}`;
            const indicador_cont_id = `indicador_id_${cont_meta - 1}${cont_indicador}`;

            dados[indicador_valor] = textarea.value;
            dados[indicador_cont_id] = textarea.id;
            console.log(dados[indicador_valor]);
            console.log(dados[indicador_cont_id]);
            cont_indicador++;
        } else if (textarea.id.startsWith("text_previsao_inicial_")) {
            const text_inicial_valor = `text_inicial_valor_${cont_meta - 1}${cont_indicador - 1}`;
            const text_inicial_cont_id = `text_inicial_cont_id_${cont_meta - 1}${cont_indicador - 1}`;

            dados[text_inicial_valor] = textarea.value;
            dados[text_inicial_cont_id] = textarea.id;

            console.log(dados[text_inicial_valor]);
            console.log(dados[text_inicial_cont_id]);
        } else if (textarea.id.startsWith("text_previsao_final_")) {
            const text_final_valor = `text_final_valor_${cont_meta - 1}${cont_indicador - 1}`;
            const text_final_cont_id = `text_final_cont_id_${cont_meta - 1}${cont_indicador - 1}`;

            dados[text_final_valor] = textarea.value;
            dados[text_final_cont_id] = textarea.id;

            console.log(dados[text_final_valor]);
            console.log(dados[text_final_cont_id]);
        } else if (textarea.id.startsWith("text_texto_")) {
            // let resto_id = textarea.id.slice(-3);
            const text_texto_avaliativo = `text_texto_avaliativo_${cont_meta - 1}${cont_indicador - 1}${cont_text_avaliativo}`;
            const text_texto_avaliativo_id = `text_texto_avaliativo_id_${cont_meta - 1}${cont_indicador - 1}${cont_text_avaliativo}`;

            dados[text_texto_avaliativo] = textarea.value;
            dados[text_texto_avaliativo_id] = textarea.id;

            console.log(dados[text_texto_avaliativo]);
            console.log(dados[text_texto_avaliativo_id]);
            cont_text_avaliativo++;
            tt++;
        }


    });
    console.error(tt, "fffffffffffffffffffffffffffffffffffffff")
    let dados_total = [];
    let ids_total = [];
    let valor_dados_executados = [];
    let id_dados_executados = [];
    let passa = 0;
    for (let i = 0; i < tabela_total.length; i++) {
        console.error(tabela_total.length);
        const tabela = tabela_total[i];
        if (tabela.id.startsWith("totaltable")) {
            let resto_id = tabela.id.slice(-3);
            passa++;
            let linhas = tabela.querySelectorAll('tbody tr');

            let linhaTotalExecutado = tabela.querySelector('tfoot.total-executado');
            let inputsExecutados = linhaTotalExecutado.querySelectorAll('td input');
            let ids_executados = [];
            let dadosExecutados = [];
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
            }
            valor_dados_executados.push(dadosExecutados);
            id_dados_executados.push(ids_executados);

            console.error('Dados Executados por ano:', ids_executados);
            console.log('Dados Executados por ano:', ids_total);

            console.log('Dados Executados por ano:', dadosExecutados.length);
            console.log('Dados Executados por ano:', dadosExecutados);
            console.log('Dados Executados por ano:', ids_executados);

            // let id_labela_total = `id_labela_total${cont_meta - 1}${cont_indicador - 1}`;

            let valor_total = `valor_total_${resto_id}`;
            let valor_total_id = `valor_total_id_${resto_id}`;

            let valor_executado = `valor_executado_${resto_id}`
            let valor_executado_id = `valor_executado_id_${resto_id}`

            dados[valor_total] = dados_total[0];;
            dados[valor_total_id] = ids_total[0];

            console.log("Antes de atribuir:", valor_dados_executados[0], id_dados_executados[0]);

            // Atribuir ao objeto 'dados'

            dados[valor_executado] = valor_dados_executados[0];
            dados[valor_executado_id] = id_dados_executados[0];

            console.log("Após atribuição:", dados[valor_executado], dados[valor_executado_id]);
            console.log(dados);




        } else {
            console.error('Nenhum input encontrado dentro de tbody.total-executado.');
        }
        // Fazendo algo com o array de dados
        //console.log('Dados Contratos por ano:', dados);
        for (let p = 0; p < dados_total.length; p++) {
            console.log('Dados Contratos por ano:', dados_total[p]);
            // console.log('Anos:', anos);
        }
        dados_total.length = 0;
        ids_total.length = 0;
        // ids_executados.length = 0;
        valor_dados_executados.length = 0;
        id_dados_executados.length = 0;
        console.log("Após atribuição:", dados["valor_executado_id2411"]);
    }

    let dadosPrevistos = [];
    let dadosPrevistosId = [];
    let dadosRealizados = [];
    let dadosRealizadosId = [];

    // Iterar sobre todas as tabelas
    for (let i = 0; i < tabela_total.length; i++) {
        const tabela = tabela_total[i];
        let resto_id = tabela.id.slice(-3);

        // Verificar se é uma tabela de previsão
        if (tabela.id.startsWith("previsto_")) {
            // Iterar sobre as linhas de previsão
            let linhasPrevisto = tabela.querySelectorAll('tbody.previsto tr');
            linhasPrevisto.forEach((linha, index) => {
                let dadosLinhaPrevisto = [];
                let dadosLinhaPrevistoId = [];

                // Iterar sobre as células da linha
                let celulas = linha.querySelectorAll('td');
                celulas.forEach((celula, index) => {
                    // Obter o valor do input na célula
                    let valor = celula.querySelector('input').value;
                    let valor_id = celula.querySelector('input').id;

                    // Adicionar o valor ao array de dados da linha

                    dadosLinhaPrevisto.push(valor);
                    dadosLinhaPrevistoId.push(valor_id);
                });
                let valor_previsto = `valor_previsto_${resto_id}`;
                dados[valor_previsto] = dadosLinhaPrevisto;

                let id_previsto = `valor_previsto_id_${resto_id}`;
                dados[id_previsto] = dadosLinhaPrevistoId;

                // Adicionar o array de dados da linha ao array principal de previsto
                dadosPrevistos.push(dadosLinhaPrevisto);
                dadosPrevistosId.push(dadosLinhaPrevistoId);
            });
            let linhasRealizado = tabela.querySelectorAll('tfoot.realizado tr');
            linhasRealizado.forEach((linha, index) => {
                let dadosLinhaRealizado = [];
                let dadosLinhaRealizadoId = [];

                // Iterar sobre as células da linha
                let celulas = linha.querySelectorAll('td');
                celulas.forEach((celula, index) => {
                    // Obter o valor do input na célula
                    let valor = celula.querySelector('input').value;
                    let valor_id = celula.querySelector('input').id;

                    // Adicionar o valor ao array de dados da linha
                    dadosLinhaRealizado.push(valor);
                    dadosLinhaRealizadoId.push(valor_id);
                    console.error(dadosLinhaRealizadoId);
                });
                // dadosLinhaRealizado.pop();
                // dadosLinhaRealizadoId.pop();
                let valor_realizado = `valor_realizado_${resto_id}`;
                dados[valor_realizado] = dadosLinhaRealizado;

                let id_realizado = `valor_realizado_id_${resto_id}`;
                dados[id_realizado] = dadosLinhaRealizadoId;

                // Adicionar o array de dados da linha ao array principal de realizados
                dadosRealizados.push(dadosLinhaRealizado);
                dadosRealizadosId.push(dadosLinhaRealizadoId);
            });
        }
    }

    // Exibir os dados previstos
    console.log('Dados Previstos:', dadosPrevistos);
    console.log('IDs dos Dados Previstos:', dadosPrevistosId);
    mandar_informacoes(dados);
}
function mandar_informacoes(objeto) {
    console.log("OBJETO", objeto);
    $.ajax({
        url: 'atualizar_programa.php',
        method: 'POST',
        data: objeto,
        success: function (resposta) {
            console.log("fg0");
            console.log(resposta);
            passa_pagina();
        },
        error: function (xhr, status, error) {
            console.error("Erro ao enviar Ajax:", status, error);
        }
    });
}
function passa_pagina() {
    window.location.href = `relatorios.php?o=1`;
}
