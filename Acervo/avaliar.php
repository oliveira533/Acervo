<?php
header("content-type:application/json");

require("conexao.php");

mysqli_query($conexao, "INSERT INTO CLASSIFICACAO (CLSUSUARIO, CLSMUSICA, CLSNOTA) VALUES (" . $_GET["usuario"] . ", "
    . $_GET["musica"] . ", " . $_GET["nota"] . ")");

$oJson->notaGeral = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT AVG(CLSNOTA) NOTA FROM CLASSIFICACAO WHERE CLSMUSICA = " . $_GET["musica"]))["NOTA"];
$oJson->notaUser = $_GET['nota'];

echo json_encode($oJson);
