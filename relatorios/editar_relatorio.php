<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

// Verificar se o índice do relatório foi passado via GET
if (!isset($_GET['relatorio'])) {
    header("Location: relatorios.php");
    exit();
}

// Obter o índice do relatório a ser editado
$relatorioIndex = $_GET['relatorio'];

// Verificar se o índice do relatório existe na sessão
if (!isset($_SESSION['relatorios'][$relatorioIndex])) {
    header("Location: relatorios.php");
    exit();
}

// Decodificar o JSON do relatório
$relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);

// Processar o formulário de edição se for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_relatorio_form'])) {
    // Atualizar os dados do relatório com base nos dados do formulário
    $relatorio['nome_projeto'] = $_POST['nome_projeto'];
    $relatorio['data_projeto'] = $_POST['data_projeto'];
    $relatorio['conclusao_projeto'] = $_POST['conclusao_projeto'];
    $relatorio['titulo'] = $_POST['titulo'];
    $relatorio['observacao'] = $_POST['observacao'];
    $relatorio['metas'] = $_POST['metas'];
    $relatorio['prazos'] = $_POST['prazos'];
    $relatorio['andamentos'] = $_POST['andamentos'];
    $relatorio['objetivos'] = $_POST['objetivos'];
    $relatorio['comentarios'] = $_POST['comentarios'];

    // Processar o formulário de edição se for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_relatorio_form'])) {
    // ... (código existente)

    // Pasta onde os anexos serão salvos
    $pastaUpload = "uploads/";

    // Verificar se existem anexos no relatório antes da edição
    $anexosExistem = isset($relatorio['anexos']) ? $relatorio['anexos'] : [];

    // Processar anexos
    if (!empty($_FILES['anexos']['name'][0])) {
        $totalAnexos = count($_FILES['anexos']['name']);
        $uploadedAnexos = [];

        // Adicionar os anexos existentes ao array de anexos enviados
        $anexosEnviados = $_FILES['anexos']['name'];

        for ($i = 0; $i < $totalAnexos; $i++) {
            $tempAnexo = $_FILES['anexos']['tmp_name'][$i];
            $nomeAnexo = $_FILES['anexos']['name'][$i];
            $destinoAnexo = $pastaUpload . $nomeAnexo;

            if (move_uploaded_file($tempAnexo, $destinoAnexo)) {
                $uploadedAnexos[] = $destinoAnexo;
            }
        }

        // Combinar anexos existentes com os novos anexos enviados
        $anexos = array_merge($anexosExistem, $uploadedAnexos);

        // Adicionar anexos ao relatório
        $relatorio['anexos'] = $anexos;
    }
    // Atualizar o relatório na sessão
    $_SESSION['relatorios'][$relatorioIndex] = json_encode($relatorio);

    // Redirecionar de volta para a página de relatórios após a edição
    header("Location: relatorios.php");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relatório - SergipeTec</title>
    <style>
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

        #formEditarRelatorio {
            width: 80%;
            max-width: 800px; /* Aumentado para 800px para acomodar os campos na horizontal */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left; /* Alinhamento à esquerda */
            margin: auto;
        }

        #formEditarRelatorio label {
            display: block;
            margin-bottom: 10px;
            /* text-align: left; Removido para manter o alinhamento à esquerda */
        }

        #formEditarRelatorio input[type="text"],
        #formEditarRelatorio textarea,
        #formEditarRelatorio input[type="date"],
        #formEditarRelatorio input[type="number"],
        #formEditarRelatorio input[type="file"] {
            width: calc(100% - 20px); /* Ajuste para a largura do input */
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block; /* Alinha os campos na horizontal */
        }

        #formEditarRelatorio input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #formEditarRelatorio input[type="submit"]:hover {
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
    </style>
</head>

<body>
    <!-- Conteúdo da Página -->
    <div class="content">
        <div id="sergipeTec">SergipeTec</div>
        <h2>Editar Relatório</h2>

        <!-- Formulário de Edição de Relatório -->
        <form id="formEditarRelatorio" action="editar_relatorio.php?relatorio=<?php echo $relatorioIndex; ?>"
            method="post" enctype="multipart/form-data">
            <!-- Adicione os campos do formulário preenchidos com as informações do relatório -->
            <label for="nome_projeto">Nome do Projeto:</label>
            <input type="text" id="nome_projeto" name="nome_projeto" value="<?php echo $relatorio['nome_projeto']; ?>" required>

            <label for="data_projeto">Data do Projeto:</label>
            <input type="date" id="data_projeto" name="data_projeto" value="<?php echo $relatorio['data_projeto']; ?>" required>

            <label for="conclusao_projeto">Porcentagem de Conclusão:</label>
            <input type="number" id="conclusao_projeto" name="conclusao_projeto" min="0" max="100"
                value="<?php echo $relatorio['conclusao_projeto']; ?>" required>

            <label for="titulo">Título do Relatório:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $relatorio['titulo']; ?>" required>

            <label for="observacao">Observação:</label>
            <textarea id="observacao" name="observacao" required><?php echo $relatorio['observacao']; ?></textarea>

            <!-- Meta 1 -->
            <label for="meta1">Meta 1:</label>
            <textarea id="meta1" name="metas[]"><?php echo $relatorio['metas'][0]; ?></textarea>

            <!-- Comentários da Meta 1 -->
            <label for="prazo1">Prazo Meta 1:</label>
            <textarea id="prazo1" name="prazos[]"><?php echo $relatorio['prazos'][0]; ?></textarea>

            <label for="andamento1">Andamento Meta 1:</label>
            <textarea id="andamento1" name="andamentos[]"><?php echo $relatorio['andamentos'][0]; ?></textarea>

            <label for="objetivo1">Objetivo Meta 1:</label>
            <textarea id="objetivo1" name="objetivos[]"><?php echo $relatorio['objetivos'][0]; ?></textarea>

            <!-- Meta 2 -->
            <label for="meta2">Meta 2:</label>
            <textarea id="meta2" name="metas[]"><?php echo isset($relatorio['metas'][1]) ? $relatorio['metas'][1] : ''; ?></textarea>

            <!-- Comentários da Meta 2 -->
            <label for="prazo2">Prazo Meta 2:</label>
            <textarea id="prazo2" name="prazos[]"><?php echo isset($relatorio['prazos'][1]) ? $relatorio['prazos'][1] : ''; ?></textarea>

            <label for="andamento2">Andamento Meta 2:</label>
            <textarea id="andamento2" name="andamentos[]"><?php echo isset($relatorio['andamentos'][1]) ? $relatorio['andamentos'][1] : ''; ?></textarea>

            <label for="objetivo2">Objetivo Meta 2:</label>
            <textarea id="objetivo2" name="objetivos[]"><?php echo isset($relatorio['objetivos'][1]) ? $relatorio['objetivos'][1] : ''; ?></textarea>

            <!-- Meta 3 -->
            <label for="meta3">Meta 3:</label>
            <textarea id="meta3" name="metas[]"><?php echo isset($relatorio['metas'][2]) ? $relatorio['metas'][2] : ''; ?></textarea>

            <!-- Comentários da Meta 3 -->
            <label for="prazo3">Prazo Meta 3:</label>
            <textarea id="prazo3" name="prazos[]"><?php echo isset($relatorio['prazos'][2]) ? $relatorio['prazos'][2] : ''; ?></textarea>

            <label for="andamento3">Andamento Meta 3:</label>
            <textarea id="andamento3" name="andamentos[]"><?php echo isset($relatorio['andamentos'][2]) ? $relatorio['andamentos'][2] : ''; ?></textarea>

            <label for="objetivo3">Objetivo Meta 3:</label>
            <textarea id="objetivo3" name="objetivos[]"><?php echo isset($relatorio['objetivos'][2]) ? $relatorio['objetivos'][2] : ''; ?></textarea>

            <label for="comentarios">Comentários Gerais:</label>
            <textarea id="comentarios" name="comentarios" required><?php echo $relatorio['comentarios']; ?></textarea>

            <label for="anexos">Anexos:</label>
            <input type="file" id="anexos" name="anexos[]" multiple>

            <input type="submit" value="Salvar Edições" name="editar_relatorio_form">
        </form>
    </div>

    <!-- Adicione a navegação aqui, se necessário -->

</body>

</html>
