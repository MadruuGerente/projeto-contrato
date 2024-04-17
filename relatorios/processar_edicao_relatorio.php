<?php
session_start();

if (isset($_POST['salvar_edicoes_form'])) {
    // Obtenha os dados do formulário
    $novoTitulo = $_POST['titulo'];
    $novoConteudo = $_POST['conteudo'];

    // Realize as validações necessárias

    // Atualize os detalhes do relatório na sessão
    $_SESSION['relatorios'][$relatorioIndex]['titulo'] = $novoTitulo;
    $_SESSION['relatorios'][$relatorioIndex]['conteudo'] = $novoConteudo;

    // Redirecione para a página de relatórios após a edição
    header("Location: relatorios.php");
    exit();
}
?>
