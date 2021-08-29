<?php
    session_start();
    $_SESSION['form'] = "Artista";
?>
<html>
<body>
<form action="cadastrar.php">
<label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
<label for="TxbInicio">Data de Inicio da Carreira</label><input type="date" name="txbInicio">
<label for="TxbFinal">Data de Termino da Carreira</label><input type="date" name="txbFinal">
<label for="txaAtrdesc">Descrição do Artista</label><textarea id="txaAtrdesc" name="txaAtrdesc"> </textarea><br>

</body>
</html>