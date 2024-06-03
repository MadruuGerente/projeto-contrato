let button = document.querySelector("#adricionar_programas");

button.addEventListener("click", function () {
    console.log("Foi, entrou!");
    // alert("dfwds");
    id_programa = this.getAttribute("name");
    let modal = document.querySelector("#modal");
    modal.style.display = "block";
});
