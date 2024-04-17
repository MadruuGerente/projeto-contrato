<?php
require_once "..\bancodedados/bd_conectar.php";
session_start();
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o botão de criação de projeto foi pressionado
    if (isset($_POST['criar_projeto'])) {
        $nome_projeto = $_POST['nome_projeto'];
        
        // Cria uma pasta para o projeto
        if (!file_exists('projetos/' . $nome_projeto)) {
            mkdir('projetos/' . $nome_projeto);
            echo "Projeto '$nome_projeto' criado com sucesso.";
            echo '<script>window.close();</script>';
        } else {
            echo "O projeto '$  ' já existe.";
        }
    }

    // Verifica se o botão de adição de setor foi pressionado
    if (isset($_POST['adicionar_setor'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['nome_setor'];
        $objetivo_setor =$_POST['objetivo'];
        
        // Cria uma pasta para o setor dentro do projeto
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor;

        // Exemplo de adição de mensagens de erro
        if (!file_exists($caminho_setor)) {
            if (mkdir($caminho_setor)) {
                echo "Setor '$nome_setor' adicionado ao projeto '$nome_projeto' com sucesso.";
                //$id_projeto = $_SESSION['id_do_projeto'];
                $login_criador = $_SESSION['login'];
                $pegar_id = "SELECT id_projeto FROM projetos WHERE nome_projeto='$nome_projeto' AND login_criador='$login_criador'";
                $resultado = $mysqli->query($pegar_id);
                if ($resultado) { 
                    $linha = $resultado->fetch_assoc();
                    $id = $linha['id_projeto'];
                    //$_SESSION['id_projeto'] = $id;
                   
                    $data = date("Y-m-d H:i:s");
                    $id_projeto = $id;
                    $chave_mysql = "INSERT INTO setor (nome, id_projeto,objetivo_setor, login_criador, dt_criado) VALUES ('$nome_setor', '$id_projeto','$objetivo_setor', '$login_criador', '$data')";

                    if ($mysqli->query($chave_mysql)) { 
                        echo "foi para o banco";
                        
                    } else {
                        echo "Erro ao criar o projeto: " . $mysqli->error;
                    }
                } else {
                    echo"$id";
                    echo "Erro ao criar o projeto: " . $mysqli->error;
                }

                

            } else {
                echo "Erro ao criar o setor '$nome_setor' no projeto '$nome_projeto'.";
            }
        } else {
            echo "O setor '$nome_setor' já existe no projeto '$nome_projeto'.";
        }

        echo "<button class=\"back-button\" onclick=\"history.back()\">Voltar</button>";
    }

    // Verifica se o botão de upload de relatório foi pressionado
    if (isset($_POST['upload_relatorio'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['setor'];

        // Define o caminho para a pasta do setor
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor . '/';

        // Verifica se o diretório do setor existe
        if (file_exists($caminho_setor)) {
            $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
            $nome_arquivo = basename($_FILES["arquivo"]["name"]);
            $caminho_destino_completo = $caminho_setor . DIRECTORY_SEPARATOR . $nome_arquivo;

            if (move_uploaded_file($arquivo_temporario, $caminho_destino_completo)) {
                echo "Arquivo '$nome_arquivo' enviado para a pasta '$caminho_destino_completo' com sucesso.";
            } else {
                echo "Erro ao enviar o arquivo.";
            }
        }
    }
}                       

// Função para obter a lista de projetos e setores
function obterProjetosSetores() {
    $projetosSetores = array();

    // Obtém todos os projetos no diretório atual
    $projetos = glob('projetos/*', GLOB_ONLYDIR);

    foreach ($projetos as $projeto) {
        // Para cada projeto, obtém os setores no diretório do projeto
        $setores = glob($projeto . '/*', GLOB_ONLYDIR);
        $projetosSetores[$projeto] = $setores;
    }

    return $projetosSetores;
}

function obterSetores($projeto) {
    // Caminho para o diretório local
    $caminho = 'projetos/' . $projeto;

    // Verifica se o diretório existe
    if (is_dir($caminho)) {
        // Lê os diretórios dentro do caminho especificado
        $pastas = scandir($caminho);

        // Remove os diretórios "." e ".."
        $setores = array_diff($pastas, array('..', '.'));

        return $setores;
    } else {
        return [];
    }
}

if (isset($_POST['projeto'])) {
    $projetoSelecionado = $_POST['projeto'];
    $setores = obterSetores($projetoSelecionado);
    echo implode(',', $setores);
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica de gerenciamento adicional pode ser adicionada aqui conforme necessário
}
?>
