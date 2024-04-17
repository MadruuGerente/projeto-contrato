    <?php 
// include 'criarel.php';
require_once "..\bancodedados/bd_conectar.php";
$cont = 1;
$con = new Conexao();
$mysqli = $con->connect();

$chave_verificar_tb_contratos = "SELECT * FROM programa";
$stmt = $mysqli->prepare($chave_verificar_tb_contratos);
// $stmt->bindParam(":id_tabela", $id_tabela_total);
// $stmt->bindParam(":ano", $ano);
$stmt->execute();
$result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    // Faça algo com os dados de cada linha, por exemplo:
    $cont = $row["id_programa"];
}
$ano = date('Y'); // Obtém o ano atual
$ultimo_digito = substr((string)$cont, -3);
$id_sequencial = $ultimo_digito + 1; // Começa o ID sequencial de 1 para este ano
$cont = $ano . '_' . str_pad($id_sequencial, 3, '0', STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Relatório - SergipeTec</title>
    <style>
        table {
            /* margin-left: 40px;
             margin-right: 1px; */
            width: 600px;
            max-width: 0.5px;
            overflow: auto;
            margin-bottom: 10px;
            /* ou outro valor desejado 
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;*/
            
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #7B68EE;
            color: #fff;
            font-weight: bold;
        }

        input {
            width: 30px;
            padding: 6px;
            box-sizing: border-box;
            font-size: 12px;
            text-align: center;
        }
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        
        nav {
            background-color: #333;
            overflow: hidden;
            text-align: center;
            width: 100%;
            position: fixed;
            top: 0;
        }

        nav a {
            display: inline-block;
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #c82333;
        }

        .content {
            text-align: center;
            margin-top: 70px; /* Ajuste para evitar sobreposição com a barra de navegação */
        }

        h2,
        h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        #sergipeTec {
            color: #8e44ad;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #formCriarRelatorio {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
            margin: auto;
        }
        #formCriarRelatorio label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        #formCriarRelatorio input[type="text"],
        #formCriarRelatorio textarea,
        #formCriarRelatorio input[type="date"],
        #formCriarRelatorio input[type="number"],
        #formCriarRelatorio input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #formCriarRelatorio input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #formCriarRelatorio input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Adiciona regras de estilo para a barra de navegação em dispositivos pequenos */
        @media screen and (max-width: 600px) {
            nav a {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
        .img{
            width: 30px;
            height: auto;
            float: right;
        }
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
    <div class="content">
        <div id="sergipeTec">SergipeTec</div>
        <h2>Criar Relatório</h2>
        <!-- Formulário de Criação de Relatório -->
        <form id="formCriarRelatorio" action="criar_relatorio.php" method="get" enctype="multipart/form-data">
            <label for="projeto" id="projeto">Informações do Projeto:</label>
            

            <label for="titulo"id="titleLabel">PROGRAMA:</label>
            <!-- <input type="text" id="titulo" name="titulo" required> -->
            <textarea name="titulo" id="programa<?php echo($cont);?>" cols="30" rows="10"  style="resize: none;height: 50px;" required> </textarea>
            <input type="hidden" name="id_do_programa" value="<?php echo($cont);?>">



            <img src="..\imagens/botao-adicionar.png" class="img" id="img_adicionar_meta" alt="teste" > <br> <br><br> <br>
            <img src="..\imagens/botao-adicionar.png" class="img" id="img_adicionar_indicador" alt="teste" > <br> <br><br> <br>
            <img src="..\imagens/botao-adicionar.png" class="img" id="imd_deletar_utimo" alt="teste" > <br> <br><br> <br>
            <button type ='submit' id="enviar" form='bora'>enviar</button>
            <label for="comentarios">Comentários Gerais:</label>
            <textarea id="comentarios" name="comentarios" required></textarea>
            <label for="anexos">Anexos:</label>
            <input type="file" id="anexos" name="anexos[]" multiple>

            <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
        </form> 
    </div>

    <nav>
        <a href="..\perfil/perfil.php">Perfil</a>
        <a href="relatorios.php">Relatórios</a>
        <a href="..\atividades/atividades.php">Atividades</a>
    </nav>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="script_criar.js"></script>
</html>
