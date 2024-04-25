function entrou(nome) {
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
    title: `Seja bem-vindo ${nome}`
  });
}
function sair() {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Tem certeza que deseja sair?",
    text: "Se sair terá que fazer o login novamente!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sim, desejo sair!",
    cancelButtonText: "Não, cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "menu.php?resultado=sair";
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      window.location.href = "menu.php?resultado=ficar";
      
    }
  });
}
var sidebar = document.getElementById("sidebar");
var menuTrigger = document.querySelector(".imagem-menu");

menuTrigger.addEventListener("click", function () {
  if (sidebar.style.display === "none" || sidebar.style.display === "") {
    sidebar.style.display = "block"; /* Mostra o menu lateral */
  } else {
    sidebar.style.display = "none"; /* Esconde o menu lateral */
  }
});