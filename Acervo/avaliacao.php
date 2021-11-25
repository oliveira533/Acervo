<!DOCTYPE html>
<?php
session_start();
require("conexao.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="avaliacao.css">
    <script src="avaliacao.js"></script>
    <title>Avaliar Musicas</title>
</head>

<body>
    <form action=""><input type="text" name="pesquisa"><button>Pesquisar</button></form>
    <a class="btn-home" href="index.php"><img class="img-home" src="https://www.svgrepo.com/show/40892/home-button.svg" /></a>

    <?php
    $pesquisa = isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : "";
    $sql = "SELECT MSCCODIGO, MSCNOME FROM MUSICAS WHERE MSCNOME LIKE '%" . $pesquisa . "%' ORDER BY MSCNOME ASC";
    $consulta = mysqli_query($conexao, $sql);
    while ($vReg = mysqli_fetch_assoc($consulta)) {
        echo "<div class='musica'>
        <span>" . $vReg["MSCNOME"] . "</span>
        <div class='estrelas'>
            <img src=' ./images/Estrela.png' id='" . $vReg["MSCCODIGO"] . "-1' alt='Estrela' onclick='fnAvalia(this.id, " . $_SESSION["USRCODIGO"] . ")'>
            <img src=' ./images/Estrela.png' id='" . $vReg["MSCCODIGO"] . "-2' alt='Estrela' onclick='fnAvalia(this.id, " . $_SESSION["USRCODIGO"] . ")'>
            <img src=' ./images/Estrela.png' id='" . $vReg["MSCCODIGO"] . "-3' alt='Estrela' onclick='fnAvalia(this.id, " . $_SESSION["USRCODIGO"] . ")'>
            <img src=' ./images/Estrela.png' id='" . $vReg["MSCCODIGO"] . "-4' alt='Estrela' onclick='fnAvalia(this.id, " . $_SESSION["USRCODIGO"] . ")'>
            <img src=' ./images/Estrela.png' id='" . $vReg["MSCCODIGO"] . "-5' alt='Estrela' onclick='fnAvalia(this.id, " . $_SESSION["USRCODIGO"] . ")'>
        </div>
    </div>";
    }
    mysqli_free_result($consulta);
    ?>

</body>

</html>