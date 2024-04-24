function entrou(nome){
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: `Seja bem-vindo ${nome}` 
      });
}
var sidebar = document.getElementById("sidebar");
var sidebar = document.getElementById("sidebar");
var menuTrigger = document.querySelector(".imagem-menu");

menuTrigger.addEventListener("click", function () {
    if (sidebar.style.display === "none" || sidebar.style.display === "") {
        sidebar.style.display = "block"; /* Mostra o menu lateral */
    } else {
        sidebar.style.display = "none"; /* Esconde o menu lateral */
    }
});