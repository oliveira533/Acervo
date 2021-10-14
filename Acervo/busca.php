<?php

function fnEscreve($Nome, $Album, $Duracao)
{
    echo "    
    <div class='musica'>
        <a href='album.php?album=$Album'>$Nome</a>
        <p>Album: $Album</p>
        <p>Duração: $Duracao</p>
    </div>
    ";
}

$conexao = mysqli_connect("localhost", "root", '', "acervo");

$sql = "SELECT MSCCODIGO, MSCNOME, MSCDURACAO, ALBNOME FROM MUSICAS JOIN faixas on FXSMUSICA = MSCCODIGO JOIN albuns ON ALBCODIGO = FXSALBUM WHERE MSCNOME LIKE '%" . $_GET["txbPesquisa"] . "%'";
$consulta = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca: <?php echo $_GET["txbPesquisa"] ?></title>
</head>

<body>

    <?php
    while ($vReg = mysqli_fetch_assoc($consulta)) {
        fnEscreve($vReg["MSCNOME"], $vReg["ALBNOME"], $vReg["MSCDURACAO"]);
    }
    ?>
</body>

</html>