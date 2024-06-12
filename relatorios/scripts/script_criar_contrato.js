let cont_contrato = window.document.querySelector("input[name='id_do_contrato']").value;


let form = document.querySelector("#formCriarRelatorio");

// document.querySelector("#enviar").addEventListener("click",function (event) {
//     event.preventDefault();
//     let nome_contrato = document.querySelector(`#nome_contrato${cont_contrato}`);
//     let numero_contrato = document.querySelector(`#numero_contrato`);
//     let meses_contrato = document.querySelector(`#meses_contrato`);
//     let bimestre_relatorio = document.querySelector(`#bimestre_relatorio`);
//     let contratante = document.querySelector(`#contratante`);
//     let contratado = document.querySelector(`#contratado`);
//     let periodo_abrangencia = document.querySelector(`#periodo_abrangencia`);
//     let objetio_contrato_gestao = document.querySelector(`#objetio_contrato_gestao`);
//     let objetivo_contratodo = document.querySelector(`#objetivo_contratodo`);
//     let os_contratados = document.querySelector(`#os_contratados`);
//     let contrato_gestao = document.querySelector(`#contrato_gestao`);
//     let plano_trabalho = document.querySelector(`#plano_trabalho`);

//     let form
// });
document.querySelector("#enviar").addEventListener("click", function (event) {
    event.preventDefault();

    // Referência para o formulário
    let formulario = document.getElementById("formCriarRelatorio");

    // Criar um novo objeto FormData com base no formulário
    let dadosDoFormulario = new FormData(formulario);
    // Exemplo de como acessar os dados do formulário
    for (let [chave, valor] of dadosDoFormulario.entries()) {
        console.log(chave, valor);
    }
    ids = pegar_programas_selecionados();
    dadosDoFormulario.append('ids_programas', JSON.stringify(ids));
    fetch('salvar_dados_contrato.php', {
        method: 'POST',
        body: dadosDoFormulario
    })
        .then(response => response.json())
        .then(data => {
            console.log('Resposta do servidor:', data);
            if (data.foi == 1) {
                window.location.href = "relatorios.php";
            }
        })
        .catch(error => {
            console.error('Erro ao enviar dados do formulário:', error);
        });
});

// Objeto para armazenar o momento em que cada checkbox foi clicado pela primeira vez
let firstClicks = {};
// Adiciona um evento de clique para cada checkbox
document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.addEventListener('click', function () {
        const id = this.id;
        const name = this.name;
        // Ação a ser executada toda vez que o checkbox for clicado
        mostrar(id, name);
        console.log(`O checkbox ${id} foi clicado.`);
        // Execute outras ações aqui, se necessário
    });
});
let uncheckedTimestamps = {};
// Adiciona um evento de mudança para cada checkbox
document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const id = this.id;
        const name = this.name;
        if (!this.checked) { // Se o checkbox foi desmarcado
            uncheckedTimestamps[id] = new Date(); // Armazena a data e hora do desmarque
            console.log(`O checkbox ${name} foi desmarcado em ${uncheckedTimestamps[id]}`);
            retirar(id, name);
        }
    });
});

let btnOpenModal = document.getElementById("openModal");
// Pega o elemento da modal
let modal = document.getElementById("modal");
// Pega o botão de fechar modal
let spanClose = document.getElementsByClassName("close")[0];
let overlay = document.getElementById("overlay");
// Quando o usuário clica no botão de abrir, abre a modal
btnOpenModal.onclick = function () {
    modal.style.display = "block";
}
// Quando o usuário clica no botão de fechar ou fora da modal, fecha a modal
spanClose.onclick = function () {
    modal.style.display = "none";
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
let info = {};
document.getElementById('pegar_porgrama').addEventListener('click', function () {
    let checkboxes = document.querySelectorAll('.checkbox');
    let selectedCheckboxes = [];
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedCheckboxes.push({ id: checkbox.id, name: checkbox.name });
        }
    });
    info.array_login = selectedCheckboxes;
    console.log("Checkboxes selecionados:", selectedCheckboxes);
    modal.style.display = "none";
});
let valor = 1;
function mostrar(id, name) {
    name = limitarCaracteres(name, 10);
    name = name.trimLeft();

    let programa_info = document.createElement("label");
    programa_info.setAttribute('id', `${id}`);
    programa_info.textContent = name;
    programa_info.setAttribute('value', `${name}`);
    programa_info.style.color = "blue"; // Exemplo de cor do texto
    programa_info.style.width = "200px";
    programa_info.style.height = "auto";

    let modal_content = document.querySelector("#formCriarRelatorio");
    let button_elemento = document.querySelector("#enviar");
    let programas_selecionados = document.querySelector("#programas_selecionados");
    console.log(modal_content, button_elemento);
    // Insere o elemento programa_info antes do botão enviar dentro do modal_content
    let pega = programas_selecionados.querySelector(`#${id}`);
    if (!pega) {
        // programas_selecionados.append(programa_num);
        programas_selecionados.append(programa_info);
        valor++;
    }
}
function retirar(id, name) {

    let retirar = document.querySelector(`#${id}`);
    if (retirar) {
        retirar.remove();
    }
    return ("blz");
}
function limitarCaracteres(texto, limite) {
    if (texto.length <= limite) {
        return texto; // Retorna o texto original se não ultrapassar o limite
    } else {
        return texto.slice(0, limite) + '...'; // Retorna o texto truncado com três pontos no final
    }
}
function pegar_programas_selecionados() {
    let label_programas = document.querySelector("#programas_selecionados");
    let label_programa = label_programas.querySelectorAll("label");
    let ids_programas = [];
    for (let i = 0; i < label_programa.length; i++) {
        console.log();
        ids_programas.push(label_programa[i].id);
    }
    console.log(ids_programas);
    return (ids_programas);
}
