<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEP</title>
</head>
<body>

<h2>Consulta de CEP</h2>

<div>
    <label for="cepInput">Informe o CEP:</label>
    <input type="text" id="cepInput" placeholder="Digite o CEP">
    <button onclick="consultarCEP()">Consultar</button>
</div>

<div id="resultado">
    <!-- Aqui serão exibidos os resultados da consulta -->
</div>

<script>
    function consultarCEP() {
        var cepInput = document.getElementById('cepInput').value;
        var resultadoDiv = document.getElementById('resultado');

        // Limpar o conteúdo anterior
        resultadoDiv.innerHTML = '';

        // Verificar se o CEP é válido (apenas números)
        if (!/^\d{8}$/.test(cepInput)) {
            resultadoDiv.innerHTML = '<p>CEP inválido. Informe um CEP válido com 8 dígitos.</p>';
            return;
        }

        // Construir a URL da API ViaCEP
        var url = 'https://viacep.com.br/ws/' + cepInput + '/json/';

        // Fazer a requisição à API
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    resultadoDiv.innerHTML = '<p>CEP não encontrado.</p>';
                } else {
                    // Exibir os resultados
                    resultadoDiv.innerHTML = `
                        <p><strong>CEP:</strong> ${data.cep}</p>
                        <p><strong>Logradouro:</strong> ${data.logradouro}</p>
                        <p><strong>Bairro:</strong> ${data.bairro}</p>
                        <p><strong>Cidade/UF:</strong> ${data.localidade}/${data.uf}</p>
                    `;
                }
            })
            .catch(error => {
                resultadoDiv.innerHTML = '<p>Ocorreu um erro ao consultar o CEP. Tente novamente.</p>';
            });
    }
</script>

</body>
</html>
