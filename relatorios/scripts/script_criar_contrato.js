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
    name = limitarCaracteres(name, 8);
    name = name.trimLeft();

    let programa_info = document.createElement("label");
    programa_info.setAttribute('id', `${id}`);
    programa_info.textContent = name;
    programa_info.setAttribute('value', `${name}`);
    programa_info.style.color = "blue"; // Exemplo de cor do texto
    programa_info.style.width = "200px";
    programa_info.style.height = "auto";

    // let programa_num = document.createElement("label");
    // programa_num.setAttribute('id', `${name}`);
    // programa_num.textContent = 'programa' + valor;
    // programa_num.setAttribute('value', `${name}`);
    // programa_num.style.color = "black"; // Exemplo de cor do texto
    // programa_num.style.width = "250px";
    // programa_num.style.height = "auto";


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

function mostrarf(selecionados) {
    let valor = 1;
    selecionados.forEach(selecionado => {

        let programa_info = document.createElement("label");
        programa_info.setAttribute('id', `${selecionado.id}`);
        programa_info.textContent = selecionado.name;
        programa_info.setAttribute('value', `${selecionado.name}`);
        programa_info.style.color = "blue"; // Exemplo de cor do texto
        programa_info.style.width = "200px";
        programa_info.style.height = "auto";

        let programa_num = document.createElement("label");
        programa_num.setAttribute('id', `programa${valor}`);
        programa_num.textContent = 'programa' + valor;
        programa_num.setAttribute('value', `${selecionado.name}`);
        programa_num.style.color = "black"; // Exemplo de cor do texto
        programa_num.style.width = "250px";
        programa_num.style.height = "auto";


        let modal_content = document.querySelector("#formCriarRelatorio");
        let button_elemento = document.querySelector("#enviar");
        let programas_selecionados = document.querySelector("#programas_selecionados");
        console.log(modal_content, button_elemento);
        // Insere o elemento programa_info antes do botão enviar dentro do modal_content


        let pega = programas_selecionados.querySelector(`#${selecionado.id}`);
        if (!pega) {
            programas_selecionados.append(programa_num);
            programas_selecionados.append(programa_info);
            valor++;
        } else {
            pega = programa_info;
        }
    });
}
function limitarCaracteres(texto, limite) {
    if (texto.length <= limite) {
        return texto; // Retorna o texto original se não ultrapassar o limite
    } else {
        return texto.slice(0, limite) + '...'; // Retorna o texto truncado com três pontos no final
    }
}