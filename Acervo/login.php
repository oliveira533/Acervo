<?php
$conexao = mysqli_connect("https://remotemysql.com","3QsQG7lKpx","UdPYkmGR2U","3QsQG7lKpx");
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
        " WHERE '" . $_GET['txbEmail'] . "' IN (USRLOGIN, USREMAIL)" .
        "   AND USRSENHA = MD5('" . $_GET['txbSenha'] . "')";
$oUsuarios = mysqli_query($conexao, $cSQL);

if($vReg = mysqli_fetch_assoc($oUsuarios))
	echo $vReg['USRNOME'];
else
	echo 'Usuário ou senha incorretos';

mysqli_free_result($oUsuarios);
mysqli_close($conexao);
?>