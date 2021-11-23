<?php 
    session_start();
    require("conexao.php");

    $sql = "SELECT MSCCODIGO, MSCNOME, MSCDURACAO, GNRNOME, BDSNOME, ARTNOME FROM MUSICAS LEFT JOIN GENEROS ON MSCGENERO = GNRCODIGO LEFT JOIN BANDAS ON MSCBANDA = BDSCODIGO LEFT JOIN ARTISTAS ON MSCARTISTA = ARTCODIGO";
    $oConsulta = mysqli_query($conexao, $mysqli);
    $oDados = mysqli_fetch_array($oConsulta);

    echo $oDados['MSCNOME'];
?>
<head>
    <title>Musicas</title>
</head>
<body>
    <section>
        
    </section>
</body>