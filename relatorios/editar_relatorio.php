<?php
// include 'criarel.php';
require_once "..\bancodedados/bd_conectar.php";
require "pegar_informacoes_pdf.php";

$cont = 1;
$con = new Conexao();
$mysqli = $con->connect();
if (isset($_GET['id'])) {
    $id_programa = $_GET['id'];
    $dados_pegos = dados_pdf($id_programa);


}

$chave_verificar_tb_contratos = "SELECT * FROM programa";
$stmt = $mysqli->prepare($chave_verificar_tb_contratos);
// $stmt->bindParam(":id_tabela", $id_tabela_total);
// $stmt->bindParam(":ano", $ano);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    // Faça algo com os dados de cada linha, por exemplo:
    $cont = $row["id_programa"];
}
$ano = date('Y'); // Obtém o ano atual
$ultimo_digito = substr((string) $cont, -3);
$id_sequencial = $ultimo_digito + 1; // Começa o ID sequencial de 1 para este ano
$cont = $ano . '_' . str_pad($id_sequencial, 3, '0', STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/style_criar_relatorio.css">
    <!-- Inclua o arquivo CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Inclua o arquivo JavaScript do Bootstrap e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Criar Relatório - SergipeTec</title>
    <style>

    </style>
</head>
<body>

    <!-- Conteúdo da Página -->
    </div>
    <div class="content">
        <div id="sergipeTec">SergipeTec</div>
        <h2>Criar Relatório</h2>
        <!-- Formulário de Criação de Relatório -->
        <div class="container">

            <form id="formCriarRelatorio" action="criar_relatorio.php" method="get" enctype="multipart/form-data">
                <label for="projeto" id="projeto">Informações do Projeto:</label>


                <label for="titulo" id="titleLabel">PROGRAMA:</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>
                <input type="hidden" name="id_do_programa" value="<?php echo ($cont); ?>">



                <img src="..\imagens/botao-adicionar.png" class="img" id="img_adicionar_meta" alt="teste"> <br> <br><br>
                <br>
                <img src="..\imagens/botao-adicionar.png" class="img" id="img_adicionar_indicador" alt="teste"> <br>
                <br><br> <br>
                <img src="..\imagens/botao-adicionar.png" class="img" id="imd_deletar_utimo" alt="teste"> <br> <br><br>
                <br>
                <button type='submit' id="enviar" form='bora'>enviar</button>
                <label for="comentarios">Comentários Gerais:</label>
                <textarea id="comentarios" name="comentarios" required></textarea>
                <label for="anexos">Anexos:</label>
                <input type="file" id="anexos" name="anexos[]" multiple>

                <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
            </form>
        </div>
    </div>

    <nav>

        <a href="..\perfil/perfil.php">Perfil</a>
        <a href="relatorios.php">Relatórios</a>
        <a href="..\atividades/atividades.php">Atividades</a>
    </nav>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts/script_editar.js"></script>

</html>