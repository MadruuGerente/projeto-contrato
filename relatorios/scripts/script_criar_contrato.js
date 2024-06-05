// let button = document.querySelector("#adricionar_programas");

// button.addEventListener("click", function () {

//     console.log("Foi, entrou!");
//     // testando();
//     // alert("dfwds"testando);
//     id_programa = this.getAttribute("name");
//     let modal = document.querySelector("#modal");
//     modal.style.display = "block";
// });
// async function testando() {
//     const { value } = await Swal.fire({
//         title: 'Termos e Condições',
//         html:
//           '<input type="checkbox" id="checkbox1" name="checkbox1" value="checkbox1">' +
//           '<label for="checkbox1">Eu concordo com os termos e condições 1</label><br>',
//         inputAttributes: {
//             'aria-label': 'checkbox'
//         },
//         focusConfirm: false,
//         preConfirm: () => {
//             const checkbox1 = document.getElementById('checkbox1');

//             return {
//                 checkbox1: checkbox1.checked,
//             };
//         },
//         allowOutsideClick: () => !Swal.isLoading()
//     });

//     if (value) {
//         const { checkbox1, checkbox2 } = value;
//         if (checkbox1 && checkbox2) {
//             Swal.fire('Você concordou com todos os termos e condições :)');
//         } else {
//             Swal.fire('Você precisa concordar com todos os termos e condições.');
//         }
//     }

// }
// Pega o botão de abrir modal
var btnOpenModal = document.getElementById("openModal");

// Pega o elemento da modal
var modal = document.getElementById("modal");

// Pega o botão de fechar modal
var spanClose = document.getElementsByClassName("close")[0];
var overlay = document.getElementById("overlay");

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

function teste(){
    alert("foiio");
}

