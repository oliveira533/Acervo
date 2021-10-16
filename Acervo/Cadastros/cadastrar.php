<?php

session_start();
$oForm = $_SESSION['form'];
require("../conexao.php");

$nQtd = 0;

$nCodgAlbum = 0;

$vCodMusica = array();

mysqli_begin_transaction($conexao);

$oQuery = "";

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
    $oAlbBanda = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : $_GET['slcArtista'];
    $oAlMidia = $_GET['txbmidia'];

    if (isset($_FILES['txbcapa'])) {
        move_uploaded_file($_FILES['txbcapa']['tmp_name'], $_FILES['txbcapa']['name']);
    }
    if ($oAlbBanda == "") {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbArtista . "','" . $oAlMidia . "')";
        echo ($oQuery);
        //mysqli_query($conexao ,$oQuery);
    } else {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbBanda . "','" . $oAlMidia . "')";
        echo ($oQuery);
        //mysqli_query($conexao ,$oQuery);

    }
    $nCodgAlbum = mysqli_insert_id($conexao);

    $nQtd = count($_GET['txtNomeMusica']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO, MSCMIDIA) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

    for ($nCont = 0; $nCont < $nQtd; $nCont++) {
        $vDadosMusica[$nCont] = array();
        $vDadosMusica[$nCont][] = $_GET['txtNomeMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txtDurMusca'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txbgenero'][$nCont];

        $vDadosMusica[$nCont][] = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : null;
        $vDadosMusica[$nCont][] = isset($_GET['slcArtista']) ? $_GET['slcArtista'] : null;

        $vDadosMusica[$nCont][] = $_GET['txaLetraMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txtVideoMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txtAudioMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txbmidia'];
        mysqli_stmt_bind_param($oCmd, 'ssiisss', ...$vDadosMusica);
    }

    mysqli_stmt_prepare($oCmd, 'INSERT INTO FAIXAS (FXSALBUM, FXSMUSICA, FXSPOSICAO) VALUES (?, ?, ?)');

    for ($nCont = 0; $nCont < $nQtd; $nCont++) {
        mysqli_stmt_bind_param($oCmd, 'iii', $nCodgAlbum, $vCodMusica[$nCont], $nCont);
        mysqli_stmt_execute($oCmd);
    }
    mysqli_commit($conexao);
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
