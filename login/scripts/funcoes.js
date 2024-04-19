function credenciaisInvalidas() {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Credenciais inválidas!",

    });
}
function usuarioInativo() {
    Swal.fire({
        icon: "success",
        title: "Usuario Inativo",
        text: "Atualizado com sucesso!",

    });
}
function senhaAtualizada() {
    Swal.fire({
        icon: "success",
        text: "Atualizado com sucesso!",

    });
}
function acessoNegado(){
    Swal.fire({
        icon: "error",
        title: "Negado",
        text: "Sua conta está inativa!",

    });
}
