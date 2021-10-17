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
    mysqli_query($conexao, $oQuery);
} else if ($oForm == "Album") {
    $oAlbNome = $_GET['NoAl'];
    $oAlbGrav = $_GET['txbgravadora'];
    $oAlbGen = $_GET['txbgenero'];
    $oAlbDtLanc = $_GET['TxbDatadeLancamento'];
    $oAlbBanda = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : (isset($_GET['slcArtista']) ? $_GET['slcArtista'] : '');
    $oAlMidia = $_GET['txbmidia'];
    $oAlbArtista = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : (isset($_GET['slcArtista']) ? $_GET['slcArtista'] : '');

    if (isset($_FILES['txbcapa'])) {
        move_uploaded_file($_FILES['txbcapa']['tmp_name'], $_FILES['txbcapa']['name']);
    }
    if ($oAlbBanda == "") {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbArtista . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
    } else {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbBanda . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
    }
    $nCodgAlbum = mysqli_insert_id($conexao);

    $nQtd = count($_GET['txtNomeMusica']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

    $vDadosMusica[] = array();

    if (!$oCmd)
    for ($nCont = 0; $nCont < $nQtd; $nCont++) {

        $vDadosMusica[$nCont][] = $_GET['txtNomeMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txtDurMusca'][$nCont];

        $vDadosMusica[$nCont][] = $_GET['txbgenero'][$nCont];
        $vDadosMusica[$nCont][] = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : null;

        $vDadosMusica[$nCont][] = isset($_GET['slcArtista']) ? $_GET['slcArtista'] : null;
        $vDadosMusica[$nCont][] = $_GET['txaLetraMusica'][$nCont];

        $vDadosMusica[$nCont][] = $_GET['txtVideoMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_GET['txtAudioMusica'][$nCont];
        mysqli_stmt_bind_param($oCmd, 'ssiiisss', ...$vDadosMusica[$nCont]);
        mysqli_stmt_execute($oCmd);
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

    $oQuery = "INSERT INTO INSTRUMENTOS (INSNOME, INSTIPO) VALUES ('" . $oInsNome . "', " . $oInsTipo . ")";
    mysqli_query($conexao, $oQuery);
} else if ($oForm == "Midia") {
    $oMdsNome = $_GET['txbNome'];
    $oMdsOnline = $_GET['Online'];

    if ($oMdsOnline == "on") {
        $oMdsOnline = 1;
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "'. 0)";
        mysqli_query($conexao, $oQuery);
    } else {
        $oMdsOnline = 0;
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "'. 1)";
        mysqli_query($conexao, $oQuery);
    }
} else if ($oForm == "Gravadora") {
    $grvNome = $_GET['txbNome'];
    $grvInin = $_GET['TxbInicio'];
    $grvFim = $_GET['TxbFinal'];

    $oQuery = "INSERT INTO GRAVADORAS (GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES ('" . $grvNome . "','" . $grvInin . "','" . $grvFim . "')";
    mysqli_query($conexao, $oQuery);
} else if ($oForm == "Artista") {
    $artNome = $_GET['txbNome'];
    $artInicio = $_GET['TxbInicio'];
    $artFim = $_GET['TxbFinal'];
    $artDesc = $_GET['txaAtrdesc'];

    $oQuery = "INSERT INTO ARTISTAS (ARTNOME, ARTDTINICIO, ARTDTTERMINO, ATRAPRESENTACAO) VALUES ('" . $artNome . "', '" . $artInicio . "', '" . $artFim . "', '" . $artDesc . "')";
    mysqli_query($conexao, $oQuery);
} else if ($oForm == "Banda") {
    $bndNome = $_GET['txbNome'];
    $bndInicio = $_GET['txbInicio'];
    $bndFim = $_GET['TxbFitxbFinalnal'];
    $bndDesc = $_GET['txaBDdesc'];
    $oQuery = "INSERT INTO BANDA (BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES ('" . $bndNome . "', '" . $bndInicio . "', '" . $bndFim . "', '" . $bndDesc . "')";
    mysqli_query($conexao, $oQuery);

    $nArtis = count($_GET['txtCodBanda[]']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO INTEGRANTES(ITGBANDA, ITGARTISTA, ITGDTINICIO, ITGDTTERMINO, ITGINSTRUMENTO) VALUES (?, ?, ?, ?, ?)");

    $nCodBanda = mysqli_insert_id($conexao);

    $vDadosBanda[] = array();

    if (!$oCmd)
    for ($nCont = 0; $nCont < $nArtis; $nCont++) {

        $vDadosBanda[][$nCont][] = $nCodBanda;
        $vDadosBanda[][$nCont][] = $_GET['slcArtista'][$nCont];

        $vDadosBanda[][$nCont][] = $_GET['txtInicio[]'][$nCont];
        $vDadosBanda[][$nCont][] = isset($_GET['txtFim']) ? $_GET['txtFim'] : null;

        $vDadosBanda[][$nCont][] = $_GET['slcInstrumento'][$nCont];
        mysqli_stmt_bind_param($oCmd, 'iissi', ...$vDadosMusica[$nCont]);
        mysqli_stmt_execute($oCmd);
    }

    mysqli_stmt_prepare($oCmd, 'INSERT INTO FAIXAS (FXSALBUM, FXSMUSICA, FXSPOSICAO) VALUES (?, ?, ?)');
}
