<?php 
include 'projj.php';
require_once "..\bancodedados/bd_conectar.php";
//session_start(); 
if (isset($_POST['nome_projeto'])) {
    $nome = $_POST['nome_projeto'];
} else {
    $nome = ""; // Ou outra lógica adequada
}

if (isset($_POST['id_projeto'])) {
    $id_projeto = $_POST['id_projeto'];
} else {
    $id_projeto = 0; // Ou outra lógica adequada
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['criar_projeto'])) {
    // Processar o formulário para criar um novo projeto
    $nome_projeto = $mysqli->real_escape_string($_POST['nome_projeto']);
    $objetivo = $mysqli->real_escape_string($_POST['objetivo']);
    $caminho_projeto = '..\projetos/projetos/';
    $login_criador = $_SESSION['login'];
    $data = date("Y-m-d H:i:s");
     // Substitua pelo caminho real do seu diretório    no servidor
    // Insira os dados do novo projeto no banco de dados
    $sql_inserir_projeto = "INSERT INTO projetos
    (nome_projeto, login_criador, caminho_projeto, objetivo,dt_criada)
    VALUES ('$nome_projeto', '$login_criador', '$caminho_projeto', '$objetivo', '$data')";

    if ($mysqli->query($sql_inserir_projeto)) { 
        echo "Projeto criado com sucesso.";
        //$pegar_id = "SELECT id_projeto FROM projetos WHERE nome_projeto='$nome_projeto' AND objetivo='$objetivo'";
        //$resultado = $mysqli->query($pegar_id);
        //if ($resultado) { 
        ///    $linha = $resultado->fetch_assoc();
            //$id = $linha['id_projeto'];
            //$_SESSION['id_projeto'] = $id;
         //} else {
           // echo"$id";
            //echo "Erro ao criar o projeto: " . $mysqli->error;
        //}
    }else{
        echo "Projeto nnn criado com sucesso.";
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

<!-- Formulário para criar projeto 
<form method="post" action="">
    <label for="nome_projeto">Nome do Projeto:</label>
    <input type="text" name="nome_projeto" required>
    <label for="objetivo">digite o objetivo:</label>
    <input type="text" name="objetivo" required>
    <button type="submit" name="criar_projeto">Criar Projeto</button>
</form>-->

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
    <input type="text" name="nome_setor" id="nome_setor" required>
    <button type="submit" name="adicionar_setor">Adicionar Setor</button>
    <button class="back-button" onclick="history.back()">Voltar</button>
</form> -->

<form method="POST">
    <label for="busca">Projeto:</label>
    <input id = "busca" type="text" name = "busca"  autocomplete="off" placeholder = "Selecione um projeto:" Value="<?=$nome?> " onkeyup ="carregar_projetos(this.value)">  
    <span id = "resultado_pesquisa"></span>
    
    <label for="nome_setor">Nome do Setor:</label>
    <input type="text" name="nome_setor" id="nome_setor" placeholder = "Digite o nome do setor:" required>

    <label for="objetivo">Objetivo:</label>
    <input type="text" name="objetivo" id="objetivo" required>
    <input type="submit" name="add" value="adicioonar setor">  
    <a href="antes_projetos.php">
    <button class="back-button" type="button">Voltar</button>
    </a>
    
    <input id = "mostrar" style="display: none;" type="text" value="<?=$id_projeto?>" name = "mostrar" placeholder = "adicione funcionarios">
</form>
<?php

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["add"])){
        if(isset($_POST["busca"])){
            if (!empty($_POST['mostrar'])) {
                $login_criador= $_SESSION['login'];
                $id_projeto = $_POST['mostrar'];
                $nome_setor = $_POST['nome_setor'];
                $objetivo_setor= $_POST['objetivo'];
                $chave_verifica= "SELECT * FROM setor WHERE nome='$nome_setor' AND id_projeto= '$id_projeto'";
                $verificacao_result = $mysqli->query($chave_verifica);
                if ($verificacao_result->num_rows > 0) {
                    $text = "Já exite um setor com esse nome!!";
                    echo"<h3>$text</h3>";
                }else{
                    $data =  date("Y-m-d H:i:s");
                    $chave_sql_adicionar = "INSERT INTO setor(nome, id_projeto,login_criador,objetivo_setor, dt_criado)VALUES('$nome_setor','$id_projeto', '$login_criador','$objetivo_setor','$data')";
                    if($mysqli->query($chave_sql_adicionar) == TRUE){
                        $linhas_afetadas = $mysqli->affected_rows;
                        if ($linhas_afetadas > 0) {
                            $text = "Adicionado com sucesso ";
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
                if ($usuarioAtual == $usuarioCorreto) {
                    echo "<option value=\"$pasta\">$pasta</option>";
                }
                //echo "<option value=\"$pasta\">$pasta</option>";
            }
        } else {
            echo "<option value=\"\">Diretório não encontrado</option>";
        }
        ?>
    </select>


    <label for="setor_upload">Setor:</label>
    <select name="setor_upload" id="setor_upload"></select> 
    <label for="arquivo">Selecione o arquivo:</label>
    <input type="file" name="arquivo" id="arquivo" required> 
    <button type="submit" name="upload_relatorio">Enviar Relatório</button> <br> <br>
      
</form>

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

<script src="projetobusca.js";>
    
</script>

<script>

/*document.addEventListener('DOMContentLoaded', function() {
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
*/
</script>

</body>
</html>
