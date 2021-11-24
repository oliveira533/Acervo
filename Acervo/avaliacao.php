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
    <?php
    $sql = "SELECT MSCCODIGO, MSCNOME FROM MUSICAS";
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
    <div class="musica">
        <span>Musica Foda</span>
        <div class="estrelas">
            <img src="./images/Estrela.png" id="5-1" alt="Estrela" onclick="fnAvalia(this.id, <?php echo $_SESSION["USRCODIGO"] ?>)">
            <img src="./images/Estrela.png" id="5-2" alt="Estrela" onclick="fnAvalia(this.id, <?php echo $_SESSION["USRCODIGO"] ?>)">
            <img src="./images/Estrela.png" id="5-3" alt="Estrela" onclick="fnAvalia(this.id, <?php echo $_SESSION["USRCODIGO"] ?>)">
            <img src="./images/Estrela.png" id="5-4" alt="Estrela" onclick="fnAvalia(this.id, <?php echo $_SESSION["USRCODIGO"] ?>)">
            <img src="./images/Estrela.png" id="5-5" alt="Estrela" onclick="fnAvalia(this.id, <?php echo $_SESSION["USRCODIGO"] ?>)">
        </div>
    </div>
</body>

</html>