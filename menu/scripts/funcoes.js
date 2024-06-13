var sidebar = document.getElementById("sidebar");
var menuTrigger = document.querySelector(".imagem-menu");
var meuPerfil = document.querySelector("#perfil");
var teste = document.querySelector(".icon-menu");

meuPerfil.addEventListener("click", function () {
  document.location.href = "../perfil/perfil.php";
  // if( teste.style.display === "none"){
  //   teste.style.display = "block";
  // }else{
  //   teste.style.display = "none";
  // }
});
meuPerfil.addEventListener("mouseover", function () {
  teste.style.display = "block";
});
meuPerfil.addEventListener("mouseleave", function () {
  teste.style.display = "none";
});
menuTrigger.addEventListener("click", function () {
  if (sidebar.className === "r") {
    // sidebar.style.opacity = "block"; /* Mostra o menu lateral */
    sidebar.classList.remove('r');
    
    sidebar.offsetHeight; 
    sidebar.classList.add('visible');
  } else if(sidebar.className === "sidebar") {
    // sidebar.style.display = "none"; /* Esconde o menu lateral */
    sidebar.classList.remove('sidebar');
    
    sidebar.offsetHeight; 
    sidebar.classList.add('visible')
  }else{
    sidebar.classList.remove('visible');
    
    sidebar.offsetHeight; 
    sidebar.classList.add('sidebar');
  }
}); 

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