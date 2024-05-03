<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['programa_valor'])) {
    $id_programa = $_POST['pega_id_programa'];
    echo("foi");
}
?>