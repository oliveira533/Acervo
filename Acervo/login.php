<?php
session_start();
$conexao = mysqli_connect("localhost","root",'',"BANCOCOMUM");
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
        " WHERE '" . $_GET['txbEmail'] . "' IN (USRLOGIN, USREMAIL)" .
        "   AND USRSENHA = MD5('" . $_GET['txbSenha'] . "')";
$oUsuarios = mysqli_query($conexao, $cSQL);

if($vReg = mysqli_fetch_assoc($oUsuarios)){
        $_SESSION["USRCODIGO"] = $vReg["USRCODIGO"];
        header("location:index.php");
}
else
	echo 'Usuário ou senha incorretos';

mysqli_free_result($oUsuarios);
mysqli_close($conexao);
?>