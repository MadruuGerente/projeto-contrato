<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();

// Certifique-se de validar e filtrar o valor do ID para evitar injeção de SQL ou outros ataques
$id_projeto = isset($_GET['id_projeto']) ? intval($_GET['id_projeto']) : 0;
$caminho_projeto = isset($_GET['caminho_projeto']) ? urldecode($_GET['caminho_projeto']) : 2;
$nome_projeto = isset($_GET['nome_projeto']) ? urldecode($_GET['nome_projeto']) :3;
/*
// Agora você pode usar $id_projeto e $caminho_projeto na sua página
echo "ID do Projeto: $id_projeto<br>";
echo "Caminho do Projeto: <a href='$caminho_projeto'> $caminho_projeto</a> ";
$chave_sql ="SELECT * FROM relatorios WHERE id_projeto='$id_projeto'";
$resultado_relatorios = $mysqli->query($chave_sql);

        if ($resultado_relatorios->num_rows > 0) {
            echo "<h2>Relatórios para o Projeto selecionado</h2>";
            echo "<ul>";

            while ($row = $resultado_relatorios->fetch_assoc()) {
                $nome_relatorio = $row["nome_relatorio"];
                $caminho_pdf = $row["caminho_pdf"];
                $login = $row["login_remetente"];
                $login_remetente = $row["login_remetente"];

                // Consulta para outra tabela usando o login
                $outra_tabela_sql = "SELECT * FROM login WHERE login='$login_remetente'";
                $resultado_outra_tabela = $mysqli->query($outra_tabela_sql);
                while ($outra_row = $resultado_outra_tabela->fetch_assoc()) {
                    $nome = $outra_row["nome"];
                    $perfil = $outra_row["perfil"];
                    echo"<span> $perfil: $nome mandou:</span> ";
                    echo "<li><a href='$caminho_pdf' target='_blank'>$nome_relatorio $login </a></li>";
                }
        
            }

            echo "</ul>";
        }
        */  
        $chave_setor ="SELECT * FROM setor WHERE id_projeto=?";
        $stmt = $mysqli->prepare($chave_setor);
        $stmt->bind_param("s", $id_projeto);
        $stmt->execute();
        $result = $stmt->get_result();
        /*while($dados = $result->fetch_assoc()){
            $nome_setor = $dados["nome"];
            echo("<h4> $nome_setor </h4>");
        }
        $stmt->close();
        $mysqli->close();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="pasta_de_estilos/verprojetoscriados.css">
    <title>Document</title>
</head>
<body class = "body">
    <header>

    </header>
    <section class ="sectionA">
        <h3>Setores do projeto</h3>
        <form method="POST">
            <!--<input id = "busca" type="text" name = "busca"  autocomplete="off" placeholder = "adicione funcionarios" onkeyup ="carregar_colaboradores(this.value)">-->   
            <span id = "resultado_pesquisa"> <?php  while($dados = $result->fetch_assoc()){
            $nome_setor = $dados["nome"];
            $id_setor = $dados["id_setor"];
            echo '<li><a href="versetorescriados.php?id_setor=' . $id_setor . '&id_projeto=' . $id_projeto . '&nome_projeto' . $nome_projeto . '">' . $dados["nome"] . '</a></li>';
        }?></span>
           <!-- <input type="submit" name="add" value="Adicionar funcionario ao projeto">  
            <input id = "mostrar" style="display: none;" type="text" name = "mostrar" placeholder = "adicione funcionarios">-->
        </form>
    </section>
    <section class ="sectionB">
        <form method="POST"action="criar_setor.php">
            <button class ="buttonsuperior" type="submit" id="butaosuperiordireito">Criar Setores</button>
            <input type="hidden" name="nome_projeto" value="<?=  $nome_projeto ?>">
            <input type="hidden" name="id_projeto" value="<?=  $id_projeto ?>">

        </form>
    </section>

    <footer>

    </footer>
    

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["add"])){
            if(isset($_POST["busca"])){
                if (!empty($_POST['mostrar'])) {
                    $login_do_colaborador = $_POST['mostrar'];
                    
                    $chave_verifica= "SELECT * FROM col_projeto WHERE login_colaborador='$login_do_colaborador' AND id_projeto='$id_projeto'";
                    $verificacao_result = $mysqli->query($chave_verifica);
                    if ($verificacao_result->num_rows > 0) {
                        $text = "Esté funcionario já está nesse projeto";
                        echo"<h3>$text</h3>";
                    }else{
                        $data =  date("Y-m-d H:i:s");
                    $chave_sql_adicionar = "INSERT INTO col_projeto(login_colaborador, id_projeto, dt_entrada)VALUES('$login_do_colaborador', '$id_projeto', '$data')";
                    if($mysqli->query($chave_sql_adicionar) == TRUE){
                        $linhas_afetadas = $mysqli->affected_rows;
                        if ($linhas_afetadas > 0) {
                            $text = "Adicionado com sucesso";
                            echo "<h3>$text</h3>";
                        } else {
                            echo "Nenhuma linha afetada. Pode não ter inserido nenhum registro.";
                        }
                    } else {
                        echo "Erro ao inserir no banco de dados: " . $mysqli->error;

                    }
                }
            }else{
                echo"<h3>Selecione um funcionario para coloca-lo no projeto!</h3>";
            }
        }
    }
 }
?>

<script src="projeto.js";> </script>
</body>
</html>