<?php
// include 'criarel.php';
require_once "..\bancodedados/bd_conectar.php";
session_start();
$login = $_SESSION["login"];
$cont = 1;
$con = new Conexao();
$mysqli = $con->connect();

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
$ge = 0;

$chave_programas = "SELECT * FROM enviar_programas WHERE login_para = :login";
$stmt_prog = $mysqli->prepare($chave_programas);
$stmt_prog->bindParam(":login", $login);
$stmt_prog->execute();

function limitarString($string, $limite)
{
    // Verifica se a string é maior que o limite
    if (strlen($string) > $limite) {
        // Corta a string até o limite desejado
        $string = substr($string, 0, $limite);
        // Adiciona os três pontos
        $string .= '...';
    }
    return $string;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/style_criar_relatorio.css">

    <!-- <link rel="stylesheet" href="pasta_de_estilos/stylerelatorio.css"> -->
    <!-- Inclua o arquivo CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <!-- Inclua o arquivo JavaScript do Bootstrap e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Criar Relatório - SergipeTec</title>
    <style>

    </style>
</head>
<script>
    function toggleMetasVisibility() {
        var meta2 = document.getElementById('meta2');
        var prazo2 = document.getElementById('prazo2');
        var andamento2 = document.getElementById('andamento2');
        var objetivo2 = document.getElementById('objetivo2');
        var meta3 = document.getElementById('meta3');
        var prazo3 = document.getElementById('prazo3');
        var andamento3 = document.getElementById('andamento3');
        var objetivo3 = document.getElementById('objetivo3');
        var checkboxMeta2 = document.getElementById('adicionar_meta2');
        var checkboxMeta3 = document.getElementById('adicionar_meta3');
        meta2.style.display = checkboxMeta2.checked ? 'block' : 'none';
        prazo2.style.display = checkboxMeta2.checked ? 'block' : 'none';
        andamento2.style.display = checkboxMeta2.checked ? 'block' : 'none';
        objetivo2.style.display = checkboxMeta2.checked ? 'block' : 'none';

        meta3.style.display = checkboxMeta3.checked ? 'block' : 'none';
        prazo3.style.display = checkboxMeta3.checked ? 'block' : 'none';
        andamento3.style.display = checkboxMeta3.checked ? 'block' : 'none';
        objetivo3.style.display = checkboxMeta3.checked ? 'block' : 'none';
    }
</script>

<body>

    <!-- Conteúdo da Página -->
    </div>
    <div class="content">
        <div id="sergipeTec">SergipeTec</div>
        <h2>Criar Contrato</h2>
        <!-- Formulário de Criação de Relatório -->
        <div class="container">

            <form id="formCriarRelatorio" enctype="multipart/form-data">
                <label for="projeto" id="projeto">Informações do contrato:</label>
                <label for="titulo" id="titleLabel">Número do contrato:</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> TEMPO:</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel">1.IDENTIFICAÇÃO</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> CONTRATANTE</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> PERÍODO DE ABRANGÊNCIA DO RELATÓRIO </label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel">2. OBJETIVO DO CONTRATO DE GESTÃO </label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> 3. OBJETIVO DA OS SERGIPETEC </label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> 4. OS SERGIPETEC, CONTRATO DE GESTÃO E PLANO DE TRABALHO</label>
                <!-- <input type="text" id="titulo" name="titulo" required> -->
                <textarea name="titulo" id="programa_<?php echo ($cont); ?>" cols="30" rows="10"
                    style="resize: none;height: 50px;" required> </textarea>

                <label for="titulo" id="titleLabel"> CONTRATANTE</label>

                <label for="titulo" id="programas_selecionados"> Programas:</label>

                <input class="input_open"type="button" id="openModal" value="Selecionar programas">

                <button type='submit' id="enviar" form='bora'>enviar</button>

                <br><br><br><br><br>


            </form>

        </div>
    </div>
    <nav>

        <a href="..\perfil/perfil.php">Perfil</a>
        <a href="relatorios.php">Relatórios</a>
        <a href="..\atividades/atividades.php">Atividades</a>
    </nav>


    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Selecione os programas:</h2>
            <div class="checkboxes">
                <?php
                while ($rgt_mega = $stmt_prog->fetch(PDO::FETCH_ASSOC)) {
                    $nome = $rgt_mega["login_de"];
                    $id_programa_enviado = $rgt_mega["id_programa_enviado"];
                    $chave_pegar = "SELECT nome_programa, cpf_criador, nome, cpf FROM programa INNER JOIN login on cpf_criador=cpf WHERE id_programa =:id_programa";
                    $stmt_programa = $mysqli->prepare($chave_pegar);
                    $stmt_programa->bindParam(":id_programa", $id_programa_enviado);
                    $stmt_programa->execute();
                    while ($row = $stmt_programa->fetch(PDO::FETCH_ASSOC)) {
                        $nome_programa = $row['nome_programa'];
                        $nome_remetente = $row['nome'];
                        ?>
                        <input class ="checkbox"type="checkbox" id="<?php echo $id_programa_enviado; ?>" name="<?php echo $nome_programa; ?>" value="<?php echo $nome; ?>">
                        <label for="<?php echo $id_programa_enviado; ?>"> <?php echo limitarString($nome_programa, 15); ?>
                            <label class="remetende"> <?php echo $nome_remetente ?>
                            </label>
                            <?php
                    }
                }
                ?>
            </div>
            <button id="pegar_porgrama">Enviar</button>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts/script_criar_contrato.js"></script>

</html>