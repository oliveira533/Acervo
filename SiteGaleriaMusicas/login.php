<?php
session_start();
$oCon = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'BANCOCOMUM');
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
		" WHERE '" . $_GET['txtLogin'] . "' IN (USRLOGIN, USREMAIL)" .
		"   AND USRSENHA = MD5('" . $_GET['txtSenha'] . "')";
$oUsuarios = mysqli_query($oCon, $cSQL);

//echo $cSQL;

if($vReg = mysqli_fetch_assoc($oUsuarios)){
	echo $vReg['USRNOME'];
	$_SESSION['USRCODIGO'] = $vReg['USRCODIGO'];
}
else
	echo 'Usuário ou senha incorretos';

mysqli_free_result($oUsuarios);
mysqli_close($oCon);
?>
