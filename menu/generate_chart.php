<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico PHP</title>
    <!-- Inclua a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Gráfico de Barras PHP</h1>

    <?php
    // Conectar ao banco de dados (substitua 'seu_banco', 'seu_usuario', 'sua_senha' e 'sua_tabela' pelos valores apropriados)
    $conn = new mysqli('localhost', 'root', '', 'sistemaacademico');

    // Verificar a conexão
    if ($conn->connect_error) {
        die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
    }

    // Consulta SQL para contar a quantidade de funcionários e gestores
    $sql = "SELECT perfil, COUNT(*) as quantidade FROM login GROUP BY perfil";
    $result = $conn->query($sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Obtém os valores do banco de dados e converte para um array
        $valores = [];
        while ($row = $result->fetch_assoc()) {
            $valores[$row['perfil']] = $row['quantidade'];
        }
    ?>

    <canvas id="grafico"></canvas>

    <script>
        // Função para gerar uma cor aleatória
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Configuração do gráfico
        var ctx = document.getElementById('grafico').getContext('2d');
        var cores = <?php echo json_encode(array_fill(0, count($valores), null)); ?>;

        var datasets = [{
            label: 'Quantidade',
            data: <?php echo json_encode(array_values($valores)); ?>,
            backgroundColor: cores.map(getRandomColor),
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }];

        var labels = <?php echo json_encode(array_keys($valores)); ?>;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <?php
    } else {
        echo 'Erro na consulta SQL: ' . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>
