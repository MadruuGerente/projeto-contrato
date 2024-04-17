<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Projetos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            display: flex;
            background-color: #eee;
            padding: 10px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ddd;
        }

        section {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Menu de Projetos</h1>
</header>

<nav>
    <a href="#" onclick="mostrarSetores()">Setores</a>
    <a href="#" onclick="mostrarRelatorios()">Relatórios</a>
</nav>

<section id="conteudo">
    <!-- O conteúdo será exibido aqui -->
</section>

<script>
    function mostrarSetores() {
        document.getElementById("conteudo").innerHTML = "<h2>Setores</h2><ul><li>Setor A</li><li>Setor B</li><li>Setor C</li></ul>";
    }

    function mostrarRelatorios() {
        document.getElementById("conteudo").innerHTML = "<h2>Relatórios</h2><ul><li>Relatório 1</li><li>Relatório 2</li><li>Relatório 3</li></ul>";
    }
</script>

</body>
</html>
