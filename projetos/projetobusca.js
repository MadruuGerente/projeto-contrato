async function carregar_projetos(valor) {
    if (valor.length >= 1) {
        console.log("abu");

        try {
            const dados = await fetch('listarprojetos.php?nome=' + valor);
            const resposta = await dados.json();

            console.log(resposta);

            var htmlArray = [];
            if (resposta.erro) {
                htmlArray.push("<li class='list-group-item disabld'>" + resposta.msg + "</li>");
            } else {
                for (let i = 0; i < resposta.dados.length; i++) {
                    htmlArray.push("<li class='list-group-item list-group-item-action' onclick='get_cpf_cola(\"" +
                        resposta.dados[i].objetivo + "\", \"" + resposta.dados[i].nome_projeto + "\", \"" +
                        resposta.dados[i].id_projeto + "\")'>" +
                        resposta.dados[i].nome_projeto +
                        "</li>");
                }
            }

            var html = "<ul class='list-group position-fixed'>" + htmlArray.join('') + "</ul>";
            document.getElementById('resultado_pesquisa').innerHTML = html;

        } catch (error) {
            console.error('Erro na requisição:', error);
        }
    }
}

function get_cpf_cola(objetivo, nome_projeto, id_projeto) {
    console.log("objetivo selecionado: " + objetivo);
    console.log("nome selecionado: " + nome_projeto);
    console.log("login selecionado: " + id_projeto);
    document.getElementById("busca").value = nome_projeto;
    document.getElementById("mostrar").value = id_projeto;
}
