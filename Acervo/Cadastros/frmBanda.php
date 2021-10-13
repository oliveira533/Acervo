<?php
    session_start();
    $_SESSION['form'] = "Banda";
?>
<html>
<body>
<form action="./Cadastros/cadastrar.php">
<label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
<label for="TxbInicio">Data de Inicio da Banda</label><input type="date" name="txbInicio">
<label for="TxbFinal">Data de Termino da Banda</label><input type="date" name="txbFinal">
<label for="txaBDdesc">Descrição da Banda</label><textarea id="txaBDdesc" name="txaBDdesc"> </textarea><br>
<button type="submit">Cadastrar</button>
</form>
</body>
</html>