<?php
session_start();
require("conexao.php");

$sql = "INSERT INTO USUARIOS (USRNOME, USRLOGIN, USREMAIL,USRSENHA) VALUES ('" . $_GET['txbUser'] . "', '" . $_GET['txbLogin'] . "', '" . $_GET['txbEmail'] . "',md5('" . $_GET['txbSenha'] . "'))";
mysqli_query($conexao, $sql);
header("location:login.php?txbEmail=" . $_GET['txbLogin'] . "&txbSenha=" . $_GET['txbSenha']);
