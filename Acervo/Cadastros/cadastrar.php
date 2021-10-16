<?php

session_start();
$oForm = $_SESSION['form'];
require("../conexao.php");

mysqli_begin_transaction($conexao)

$oQuery;

if ($oForm == "Genero") {
    $oGenNome = $_GET['txbNome'];
    $oGenDesc = $_GET['txadesc'];
    $oQuery = "INSERT INTO GENEROS (GNRNOME, GNRDESCRICAO) VALUES ('" . $oGenNome . "', '" . $oGenDesc . "')";
    echo ($oQuery);
    //mysqli_query($conexao ,$oQuery);

} else if ($oForm == "Album") {
    $oAlbNome = $_GET['NoAl'];
    $oAlbGrav = $_GET['txbgravadora'];
    $oAlbGen = $_GET['txbgenero'];
    $oAlbDtLanc = $_GET['TxbDatadeLancamento'];
    $oAlbBanda = $_GET['txbBanda'];
    $oAlbArtista = $_GET['txbArtista'];
    $oAlMidia = $_GET['txbmidia'];

    if ($oAlbBanda == "") {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbArtista . "','" . $oAlMidia . "')";
        echo ($oQuery);
        //mysqli_query($conexao ,$oQuery);
    } else {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbBanda . "','" . $oAlMidia . "')";
        echo ($oQuery);
        //mysqli_query($conexao ,$oQuery);

    }

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSER INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param('ssiisss', $_GET['txtNomeMusica'][0], $_GET['txtDurMusca'][0], $_GET['txbgenero'][0], $_GET['txbBanda'][0], $_GET['txbArtista'][0], $_GET['txaLetraMusica'][0], $_GET['txtVideoMusica'][0], $_GET['txtAudioMusica'][0]);

} else if ($oForm == "Insturmento") {
    $oInsNome = $_GET['txbNome'];
    $oInsTipo = $_GET['slcTipo'];

    $oQuery = "INSERT INTO INSTRUMNENTOS (INSNOE, INSTIPO) VALUES ('" . $oInsNome . "', " . $oInsTipo . ")";
    echo ($oQuery);
    //mysqli_query($conexao ,$oQuery);

} else if ($oForm == "Midia") {
    $oMdsNome = $_GET['txbNome'];
    $oMdsOnline = $_GET['Online'];

    if ($oMdsOnline == "on") {
        $oMdsOnline = 1;
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "'. 0)";
        echo "on";
        //mysqli_query($conexao ,$oQuery);
    } else {
        $oMdsOnline = 0;
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "'. 1)";
        echo "off";
        //mysqli_query($conexao ,$oQuery);
    }
} else if ($oForm == "Gravadora") {
    $grvNome = $_GET['txbNome'];
    $grvInin = $_GET['TxbInicio'];
    $grvFim = $_GET['TxbFinal'];

    $oQuery = "INSERT INTO GRAVADORAS (GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES ('" . $grvNome . "','" . $grvInin . "','" . $grvFim . "')";
    echo ($oQuery);
    //mysqli_query($conexao ,$oQuery);
} else if ($oForm == "Artista") {
    $artNome = $_GET['txbNome'];
    $artInicio = $_GET['TxbInicio'];
    $artFim = $_GET['TxbFinal'];
    $artDesc = $_GET['txaAtrdesc'];

    $oQuery = "INSERT INTO ARTISTAS (ARTNOME, ARTDTINICIO, ARTDTTERMINO, ATRAPRESENTACAO) VALUES ('" . $artNome . "', '" . $artInicio . "', '" . $artFim . "', '" . $artDesc . "')";
    echo ($oQuery);
    //mysqli_query($conexao ,$oQuery);
} else if ($oForm == "Banda") {
    $bndNome = $_GET['txbNome'];
    $bndInicio = $_GET['TxbInicio'];
    $bndFim = $_GET['TxbFinal'];
    $bndDesc = $_GET['txaBDdesc'];

    $oQuery = "INSERT INTO BANDA (BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES ('" . $bndNome . "', '" . $bndInicio . "', '" . $bndFim . "', '" . $bndDesc . "')";
    echo ($oQuery);
    //mysqli_query($conexao ,$oQuery);
}
