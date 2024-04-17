async function carregar_colaboradores(valor){
    if(valor.length >= 1){
        console.log("abu");
        const dados = await fetch('listarcolaboradores.php?nome=' + valor);
        const resposta = await dados.json();
        console.log(resposta); 

        var html = "<ul class='list-group position-fixed'>";
        if(resposta['erro']){
            html += "<li class='list-group-item disabld'>" + resposta['msg'] + " </li>";
        }else{
            for(i=0;i<resposta['dados'].length;i++){
                html += "<li class='list-group-item list-group-item-action' onclick='get_cpf_cola(\"" +
                    resposta['dados'][i].cpf + "\", \"" +  resposta['dados'][i].nome + "\", \""  + resposta['dados'][i].login + "\")'>" +
                    resposta['dados'][i].nome +
                     " </li>";
            }
        }
        html += "</ul>"
        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}
function get_cpf_cola(cpf, nome, login){
    console.log("cpf selecionado " + cpf);
    console.log("nome selecionado " + nome);
    console.log("login selecionado " + login);
    document.getElementById("busca").value = nome;
    document.getElementById("mostrar").value = login;
}