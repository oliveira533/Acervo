<!DOCTYPE html>
<?php
session_start();
$_SESSION['form'] = "Instrumento";
?>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="./Cadastros/cadastrar.php" method="POST">
        <input type="text" name="txbNome" id="txbNome">
        <select name="slcTipo" id="slcTipo">
            <option value="1">Cordas</option>
            <option value="2">Sopro</option>
            <option value="3">Percursão</option>
            <option value="4">Teclas</option>
        </select>
        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>