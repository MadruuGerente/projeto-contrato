<?php 
include 'projj.php';
require_once "..\bancodedados/bd_conectar.php";
//session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['criar_projeto'])) {
    // Processar o formulário para criar um novo projeto
    $nome_projeto = $mysqli->real_escape_string($_POST['nome_projeto']);
    $objetivo = $mysqli->real_escape_string($_POST['objetivo']);
    $caminho_projeto = '..\projetos/projetos/';
    $login_criador = $_SESSION['login'];
    $data = date("Y-m-d H:i:s");

    // Verificar se o nome do projeto já existe
    $sql_verificar_nome = "SELECT * FROM projetos WHERE nome_projeto = '$nome_projeto' AND login_criador = '$login_criador'";
    $resultado_verificar_nome = $mysqli->query($sql_verificar_nome);

    if ($resultado_verificar_nome->num_rows > 0) {
        echo "Erro: O nome do projeto já existe. Escolha um nome diferente.";
    } else {
        // Inserir os dados do novo projeto no banco de dados
        $sql_inserir_projeto = "INSERT INTO projetos (nome_projeto, login_criador, caminho_projeto, objetivo, dt_criada)
                                VALUES ('$nome_projeto', '$login_criador', '$caminho_projeto', '$objetivo', '$data')";

        if ($mysqli->query($sql_inserir_projeto)) {
            echo "Projeto criado com sucesso.";
        } else {
            echo "Erro ao criar o projeto: " . $mysqli->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Projetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<h1>Sistema de Projetos</h1>

<!-- Formulário para criar projeto -->
<form method="post" action="">
    <label for="nome_projeto">Nome do Projeto:</label>
    <input type="text" name="nome_projeto" required>
    <label for="objetivo">digite o objetivo:</label>
    <input type="text" name="objetivo" required>
    <button type="submit" name="criar_projeto">Criar Projeto</button>
    <a href="antes_projetos.php">
    <button class="back-button" type="button">Voltar</button>
    </a>
</form>

<!-- Formulário para adicionar setor 
<form method="post" action="">
    <label for="projeto">Escolha um projeto:</label>
    <select name="projeto" id="projeto">
        <?php
        // Caminho para o diretório local
        $caminho = 'projetos/';

        // Verifica se o diretório existe
        if (is_dir($caminho)) {
            // Lê os diretórios dentro do caminho especificado
            $pastas = scandir($caminho);

            // Remove os diretórios "." e ".."
            $pastas = array_diff($pastas, array('..', '.'));

            // Exibe cada pasta como uma opção no combo box
            foreach ($pastas as $pasta) {
                echo "<option value=\"$pasta\">$pasta</option>";
            }
        } else {
            echo "<option value=\"\">Diretório não encontrado</option>";
        }
        ?>
    </select>
    <label for="nome_setor">Nome do Setor:</label>
    <input type="text" name="nome_setor" id="nome_setor" required>
    <button type="submit" name="adicionar_setor">Adicionar Setor</button>
</form>
-->
<!-- Formulário para fazer upload de relatório 
<form method="post" action="upload.php" enctype="multipart/form-data">

    <label for="projeto_upload">Escolha um projeto:</label>
    <select name="projeto_upload" id="projeto_upload">
        <?php
        // Caminho para o diretório local
        $caminho = 'projetos/';

        // Verifica se o diretório existe
        if (is_dir($caminho)) {
            // Lê os diretórios dentro do caminho especificado
            $pastas = scandir($caminho);

            // Remove os diretórios "." e ".."
            $pastas = array_diff($pastas, array('..', '.'));

            // Exibe cada pasta como uma opção no combo box
            foreach ($pastas as $pasta) {
                echo "<option value=\"$pasta\">$pasta</option>";
            }
        } else {
            echo "<option value=\"\">Diretório não encontrado</option>";
        }
        ?>
    </select>
-->
<!--
    <label for="setor_upload">Setor:</label>
    <select name="setor_upload" id="setor_upload"></select> 
    <label for="arquivo">Selecione o arquivo:</label>
    <input type="file" name="arquivo" id="arquivo" required> 
    <button type="submit" name="upload_relatorio">Enviar Relatório</button> <br> <br>
      
</form>--> 
<!--
<form method = "POST">
    <label for="LabelBuscar">Adicionar funcionarios </label>
    <input id = "busca" type="text" name = "busca" placeholder = "adicione funcionarios" onkeyup ="carregar_colaboradores(this.value)">
    <span id = "resultado_pesquisa"></span>
    <input type="text" name = "msg" placeholder = "mensagem">
    <input type="submit" name="buttonBuscar" value = "Buscar funcionario"></button> <br>
</form>
-->

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['busca'])) {
            if (isset($_POST['buttonBuscar'])) {
                $cpf=$_SESSION['cpf'];
                $sqlii = "SELECT * FROM login WHERE cpf='$cpf'";
                $pesquisa = $mysqli->real_escape_string($_POST['busca']);
                $mensagenss =$_POST['msg'];
                $sql_queryy = $mysqli->query($sqlii) or die("ERRO ao consultar! " . $mysqli->error); 

                $sql_code = "SELECT * 
                    FROM login 
                    WHERE nome ='$pesquisa'";
                $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 

                if ($sql_query->num_rows == 0) {
             
                    } else {
                        $dadospara = $sql_query->fetch_assoc();
                        $dadosde = $sql_queryy->fetch_assoc();
                        $dataAtual = new DateTime();
                        $nomede = $dadosde['cpf'];
                        $nomepara =$dadospara['cpf'];
                        $mensagem = $mensagenss;
                        $data =  date("Y-m-d H:i:s");
                        $sql_menss = " INSERT INTO notatividades(de, para, projeto, datanot) VALUES ('$nomede','$nomepara','$mensagem','$data')";
                        $sql_mens = $mysqli->query($sql_menss) or die("ERRO ao consultar! " . $mysqli->error); 

                        while($dadospara = $sql_query->fetch_assoc()) {
                   
        
                    }
                    
                }
            }
        }
    }
         
        //} ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="projeto.js";>
    
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var projetoSelect = document.getElementById('projeto_upload');
    var setorSelect = document.getElementById('setor_upload');

    projetoSelect.addEventListener('change', function() {
        var projetoSelecionado = projetoSelect.value;
        if (projetoSelecionado) {
            // Enviar requisição para obter setores correspondentes ao projeto
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var setores = this.responseText.split(',');
                    // Limpar e preencher o campo de setores
                    setorSelect.innerHTML = "";
                    for (var i = 0; i < setores.length; i++) {
                        var option = document.createElement("option");
                        option.text = setores[i];
                        setorSelect.add(option);
                    }
                }
            };

            xhr.open("POST", "projj.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("projeto=" + projetoSelecionado);
        } else {
            // Limpar o campo de setores se nenhum projeto for selecionado
            setorSelect.innerHTML = "";
        }
    });
});
</script>

</body>
</html>
