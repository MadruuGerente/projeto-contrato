let links_enviar = document.querySelectorAll(".bt");
let id_programa = 0;
if (links_enviar) {
    links_enviar.forEach(function(link_enviar) {
        link_enviar.addEventListener("click", function () {
            console.log("Foi, entrou!");
            id_programa = this.getAttribute("name");
            let modal = document.querySelector("#modal");
            modal.style.display = "block";
        });
    });
}else {
}

let info = {};
document.querySelector('.button_modal').addEventListener('click', function () {
    let checkboxes = document.querySelectorAll('.checkboxes');
    let selectedCheckboxes = [];

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            selectedCheckboxes.push(checkbox.id);
        }
    });
    info.array_login = selectedCheckboxes;
    info.id_programa = id_programa;
    console.log("Checkboxes selecionados:", selectedCheckboxes);
    console.log("Checkboxes :", id_programa);
    enviar(info);
});

function enviar(objeto) {
    console.log("OBJETO", objeto);
    $.ajax({
        url: 'enviar_programa.php',
        method: 'POST',
        data: objeto,
        success: function (resposta) {
            if (resposta == 1) {
                let modal = document.querySelector("#modal");
                modal.style.display = "none";
                entrou();
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao enviar Ajax:", status, error);
        }
    });
};


var sidebar = document.getElementById("sidebar");
var menuTrigger = document.querySelector(".imagem-menu");
let meuPerfil = document.querySelector("#perfil");
meuPerfil.addEventListener("click", function () {
    document.location.href = "../perfil/perfil.php";
});
menuTrigger.addEventListener("click", function () {
    if (sidebar.style.display === "none" || sidebar.style.display === "") {
        sidebar.style.display = "block"; /* Mostra o menu lateral */
    } else {
        sidebar.style.display = "none"; /* Esconde o menu lateral */
    }
});


function entrou() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: `Enviado com sucesso!`
    });
}