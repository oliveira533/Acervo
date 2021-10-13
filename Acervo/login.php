<?php
session_start();
try {
        $conexao = mysqli_connect("localhost", "Aluno2DS", "SenhaBD2", "ACERVO");
} catch (Exception $erro) {
        $conexao = mysqli_connect("localhost", "root", '', "acervo");
}
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
        " WHERE '" . $_GET['txbEmail'] . "' IN (USRLOGIN, USREMAIL)" .
        "   AND USRSENHA = MD5('" . $_GET['txbSenha'] . "')";
$oUsuarios = mysqli_query($conexao, $cSQL);

if ($vReg = mysqli_fetch_assoc($oUsuarios)) {
        $_SESSION["USRCODIGO"] = $vReg["USRCODIGO"];
        $_SESSION["USRNOME"] = $vReg["USRNOME"];
        header("location:index.php");
} else
        header("location:login.htm?errado=true");

mysqli_free_result($oUsuarios);
mysqli_close($conexao);
