<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se foi enviado um arquivo
    if (isset($_FILES['arquivo'])) {
        $arquivo_nome = $_FILES['arquivo']['name'];
        $arquivo_temp = $_FILES['arquivo']['tmp_name'];

        // Verificar se o arquivo é um PDF (você pode adicionar mais verificações, se necessário)
        $extensao = pathinfo($arquivo_nome, PATHINFO_EXTENSION);
        if (strtolower($extensao) === 'pdf') {
            // Mover o arquivo para o diretório 'uploads'
            $destino = 'uploads/' . $arquivo_nome;
            move_uploaded_file($arquivo_temp, $destino);

            echo "Upload bem-sucedido! O arquivo está em: $destino";
        } else {
            echo "Erro: O arquivo deve ser um PDF.";
        }
    } else {
        echo "Erro ao enviar o arquivo. Certifique-se de escolher um arquivo.";
    }
}
?>
