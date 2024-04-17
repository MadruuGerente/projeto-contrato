<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Atividades</title>
</head>
<body>
    <h2>Atividades Disponíveis</h2>

    <?php
    $diretorioDestino = "caminho/do/diretorio/destino/"; // Substitua pelo diretório desejado

    // Verifica se o diretório de destino existe
    if (is_dir($diretorioDestino)) {
        // Obtém a lista de pastas no diretório
        $pastas = glob($diretorioDestino . 'atividades_*', GLOB_ONLYDIR);

        if (empty($pastas)) {
            echo "<p>Nenhuma atividade disponível no momento.</p>";
        } else {
            echo "<ul>";

            // Exibe as pastas como links para download
            foreach ($pastas as $pasta) {
                $nomeAtividade = basename($pasta);
                echo "<li><a href='baixar_atividade.php?atividade={$nomeAtividade}'>{$nomeAtividade}</a></li>";
            }

            echo "</ul>";
        }
    } else {
        echo "<p>Diretório de destino não encontrado.</p>";
    }
    ?>

</body>
</html>
