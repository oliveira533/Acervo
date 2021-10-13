<?php 
    session_start();
    $_SESSION['form'] = "Midia";
?>
<html>
<style>
p,
label {
    font: 1rem 'Fira Sans', sans-serif;
}

input {
    margin: .4rem;
}
</style>
    <body>
<form action="./Cadastros/cadastrar.php">
<label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
<p>A mídia é online? </p>

<div>
  <label for="Online">Online</label>
  <input type="checkbox" id="Online" name="Online" checked>
</div>

<br>
<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
</form>
</body>
</html>