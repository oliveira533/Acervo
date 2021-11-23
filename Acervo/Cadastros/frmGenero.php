<?php
session_start();
$_SESSION['form'] = "Genero";
?>
<html>

<body>
    <form action="./Cadastros/cadastrar.php" method="POST">
        <label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
        <label for="txadesc">Descrição</label><textarea id="txadesc" name="txadesc"> </textarea><br>
        <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
    </form>
</body>

</html>