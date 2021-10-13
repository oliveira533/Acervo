<?php
    session_start();
    $_SESSION['form'] = "Gravadora";
?>
<html>
<body>
<form action="cadastrar.php">
<label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
<label for="TxbInicio">Data de Inauguração da Gravadora</label><input type="date" name="txbInicio">
<label for="TxbFinal">Data de Falimento da Gravadora</label><input type="date" name="txbFinal">
<button type="submit">cadastrar</button>
</form>
</body>
</html>