<html>
    <form action="../cadastrar.php"></form>
    <body>
<form method="POST" action="../cadastrar.php">
<label for="NoAl">Nome</label><input type="text" name="NoAl" id="NoAl"><br>
<label fro="txbgravadora">Gravadora</label><select name="txbgravadora">
    <?php
    $conexao = mysqli_connect("localhost","root",'',"BANCOCOMUM");
    $sql = "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS"
    $consulta = mysqli_query($conexao, $sql);
    while($vReg = mysqli_fetch_assoc($consulta)){
    echo"<option value='". $vReg["GRVCODIGO"] ."'>". $vReg["GRVNOME"] ."</option>";
    }
    ?>   
</select><br>
<label for="txbgenero">Genero</label><select name="txbgenero">
    <?php
    $sql = "SELECT GNRCODIGO, GNRNOME FROM GENEROS"
    $consulta = mysqli_query($conexao, $sql);
    while($vReg = mysqli_fetch_assoc($consulta)){
    echo"<option value='". $vReg["GNRCODIGO"] ."'>". $vReg["GNRNOME"] ."</option>";
    }
    ?>   
</select><br>
<label for="TxbDatadeLancamento">Data de Lançamento</label><input type="date" name="TxbDatadeLancamento"><br>
<label for="txbgenero">Banda</label><input type="text" name="" id=""><br>
<label for="txbgenero">Artita</label><input type="text" name="" id=""><br>
<label for="txbcapa">Imagem da Capa</label><br><input type="file" name="txbcapa" id=""><br>
<label for="txbmidia">Midia</label><select name="txbmidia">
    <?php
    $sql = "SELECT MDSCODIGO, MDSNOME FROM MIDIAS"
    $consulta = mysqli_query($conexao, $sql);
    while($vReg = mysqli_fetch_assoc($consulta)){
    echo"<option value='". $vReg["GNRCODIGO"] ."'>". $vReg["GNRNOME"] ."</option>";
    }
    ?>   
</select><br>
<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
</form>
</body>
</html>