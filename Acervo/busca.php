<?php

function fnEscreve($Nome, $Album, $Duracao)
{
    echo "    
    <div class='musica'>
        <a href='album.php?album=$Album'>$Nome</a>
        <a href='album.php?album=$Album'>Album: $Album</a>
        <p>Duração: $Duracao</p>
    </div>
    ";
}

require("conexao.php");
$busca = $_GET["txbPesquisa"];

$sql = "SELECT MSCCODIGO, MSCNOME, MSCDURACAO, ALBNOME FROM MUSICAS JOIN 
FAIXAS on FXSMUSICA = MSCCODIGO JOIN ALBUNS ON ALBCODIGO = FXSALBUM 
JOIN GENEROS ON MSCGENERO = GNRCODIGO LEFT JOIN ARTISTAS ON ALBARTISTA = ARTCODIGO
LEFT JOIN BANDAS ON BDSCODIGO = ALBBANDA
WHERE MSCNOME LIKE '%$busca%' OR ALBNOME LIKE '%$busca%' OR GNRNOME LIKE '%$busca%' OR ARTNOME LIKE '%$busca%' OR BDSNOME LIKE '%$busca%' ORDER BY MSCNOME ASC;";
$consulta = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="busca.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca: <?php echo $_GET["txbPesquisa"] ?></title>
</head>

<body>
    <img class="logo" src="./images/BananaDeCalcinha.png" />

    <?php
    while ($vReg = mysqli_fetch_assoc($consulta)) {
        fnEscreve($vReg["MSCNOME"], $vReg["ALBNOME"], $vReg["MSCDURACAO"]);
    }
    ?>
    <a href="index.php"><img src="https://www.svgrepo.com/show/40892/home-button.svg" alt="" width="40px" /></a>

</body>

</html>