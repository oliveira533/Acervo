<?php

session_start();
$_SESSION["artistas"] = isset($_SESSION["artistas"]) ? $_SESSION["artistas"] : array();
$_SESSION["bandas"] = isset($_SESSION["bandas"]) ? $_SESSION["bandas"] : array();
$_SESSION["albuns"] = isset($_SESSION["albuns"]) ? $_SESSION["albuns"] : array();

$oForm = $_SESSION['form'];
require("../conexao.php");

$nQtd = 0;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nCodgAlbum = 0;

$vCodMusica = array();

$cNomeArq = '';

mysqli_begin_transaction($conexao);

$oQuery = "";

if ($oForm == "Genero") {
    $oGenNome = $_POST['txbNome'];
    $oGenDesc = $_POST['txadesc'];
    $oQuery = "INSERT INTO GENEROS (GNRNOME, GNRDESCRICAO) VALUES ('" . $oGenNome . "', '" . $oGenDesc . "')";
    echo ($oQuery);
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);

    //esse if faz um insert na tabela genero 
} else if ($oForm == "Album") {
    $cNomeArq = $_POST['NoAl'] . date('Ymd') . '.' . (pathinfo($_FILES['txbcapa']['name'])['extension']);
    $oAlbNome = $_POST['NoAl'];
    $oAlbGrav = $_POST['txbgravadora'];
    $oAlbGen = $_POST['txbgenero'];
    $oAlbDtLanc = $_POST['TxbDatadeLancamento'];
    $oAlbBanda = isset($_POST['slcBanda']) ? $_POST['slcBanda'] : (isset($_POST['slcArtista']) ? $_POST['slcArtista'] : '');
    $oAlMidia = $_POST['txbmidia'];
    $oAlbArtista = isset($_POST['slcBanda']) ? $_POST['slcBanda'] : (isset($_POST['slcArtista']) ? $_POST['slcArtista'] : '');
    $vDadosAlbum[] = ($cNomeArq == '' ? null : $cNomeArq);

    echo $cNomeArq;
    //esse else if verifica se o check da banda ou artista esta marcado 
    if (isset($_FILES['txbcapa'])) {
        move_uploaded_file($_FILES['txbcapa']['tmp_name'], '../images/' . $cNomeArq);
        //ele faz upload da img da capa e do nome dessa img
    }
    if ($oAlbBanda == "") {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBCAPA, ALBARTISTA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $cNomeArq . "', '" . $oAlbArtista . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
        echo $oQuery;
        //faz insert n tabela abuns com um artista
    } else {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBCAPA, ALBBANDA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $cNomeArq . "','" . $oAlbBanda . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
        echo $oQuery;
        //faz insert n tabela abuns com uma banda

    }
    $nCodgAlbum = mysqli_insert_id($conexao);

    $nQtd = count($_POST['txtNomeMusica']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    // preparando um comando insert para a tabela musicas
    $vDadosMusica[] = array();

    for ($nCont = 0; $nCont < $nQtd; $nCont++) {

        $vDadosMusica[$nCont][] = $_POST['txtNomeMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_POST['txtDurMusca'][$nCont];

        $vDadosMusica[$nCont][] = $_POST['txbgenero'][$nCont];
        $vDadosMusica[$nCont][] = isset($_POST['slcBanda']) ? $_POST['slcBanda'] : null;

        $vDadosMusica[$nCont][] = isset($_POST['slcArtista']) ? $_POST['slcArtista'] : null;
        $vDadosMusica[$nCont][] = $_POST['txaLetraMusica'][$nCont];

        $vDadosMusica[$nCont][] = $_POST['txtVideoMusica'][$nCont];
        $vDadosMusica[$nCont][] = $_POST['txtAudioMusica'][$nCont];
        mysqli_stmt_bind_param($oCmd, 'ssiiisss', ...$vDadosMusica[$nCont]);
        mysqli_stmt_execute($oCmd);
    }

    mysqli_stmt_prepare($oCmd, 'INSERT INTO FAIXAS (FXSALBUM, FXSMUSICA, FXSPOSICAO) VALUES (?, ?, ?)');
    // preparando um comando insert para a tabela faixas
    for ($nCont = 0; $nCont < $nQtd; $nCont++) {
        mysqli_stmt_bind_param($oCmd, 'iii', $nCodgAlbum, $vCodMusica[$nCont], $nCont);
        mysqli_stmt_execute($oCmd);
    }
    mysqli_commit($conexao);
    array_push($_SESSION["albuns"], $oAlbNome);
} else if ($oForm == "Instrumento") {
    $oInsNome = $_POST['txbNome'];
    $oInsTipo = $_POST['slcTipo'];

    $oQuery = "INSERT INTO INSTRUMENTOS (INSNOME, INSTIPO) VALUES ('" . $oInsNome . "', " . $oInsTipo . ")";
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);
    // insert na tabela instrumentos
} else if ($oForm == "Midia") {
    $oMdsNome = $_POST['txbNome'];
    $oMdsOnline = isset($_POST['Online']) ? $_POST['Online'] : 'off';

    if ($oMdsOnline == "on") {
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "', 1)";
        // insert de midias online
    } else {
        $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('" . $oMdsNome . "', 0)";
        // insert de midias não online
    }
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);
} else if ($oForm == "Gravadora") {
    $grvNome = $_POST['txbNome'];
    $grvInin = $_POST['txbInicio'];
    $grvFim = $_POST['txbFinal'] !== '' ? "'" . $_POST['txbFinal'] . "'" : "null";
    $oQuery = "INSERT INTO GRAVADORAS (GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES ('" . $grvNome . "','" . $grvInin . "', $grvFim)";

    echo $oQuery;

    mysqli_query($conexao, $oQuery);

    mysqli_commit($conexao);

    // insert de gravadoras
} else if ($oForm == "Artista") {
    $artNome = $_POST['txbNome'];
    $artInicio = $_POST['txbInicio'];
    $artFim = $_POST['txbFinal'] !== '' ? "'" . $_POST['txbFinal'] . "'" : "null";
    $artDesc = $_POST['txaAtrdesc'];
    $oQuery = "INSERT INTO ARTISTAS (ARTNOME, ARTDTINICIO, ARTDTTERMINO, ARTAPRESENTACAO) VALUES ('" . $artNome . "', '" . $artInicio . "', $artFim, '" . $artDesc . "')";
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);
    array_push($_SESSION["artistas"], $artNome);
} else if ($oForm == "Banda") {
    mysqli_begin_transaction($conexao);

    $bndNome = $_POST['txbNome'];
    $bndInicio = $_POST['txbInicio'];
    $bndFim = isset($_POST['TxbFinal']) ? $_POST['TxbFinal'] : null;
    $bndDesc = $_POST['txaBDdesc'];
    $bndFim = isset($bndFim) ? "'" . $bndFim . "'" : "Null";
    $oQuery = "INSERT INTO BANDAS (BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES ('" . $bndNome . "', '" . $bndInicio . "', " . $bndFim . ", '" . $bndDesc . "')";
    mysqli_query($conexao, $oQuery);
    echo $oQuery;
    // insert de bandas
    $nArtis = count($_POST['slcArtista']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO INTEGRANTES(ITGBANDA, ITGARTISTA, ITGDTINICIO, ITGDTTERMINO, ITGINSTRUMENTO) VALUES (?, ?, ?, ?, ?)");
    // insert de integrantes da banda
    $nCodBanda = mysqli_insert_id($conexao);

    $vDadosBanda[] = array();


    for ($nCont = 0; $nCont < $nArtis; $nCont++) {

        $vDadosBanda[$nCont][] = $nCodBanda;
        $vDadosBanda[$nCont][] = $_POST['slcArtista'][$nCont];

        $vDadosBanda[$nCont][] = isset($_POST['txtInicio']) ? $_POST['txtInicio'][$nCont] : "null";
        $vDadosBanda[$nCont][] = isset($_POST['txtFim']) ? $_POST['txtFim'][$nCont] : "null";

        $vDadosBanda[$nCont][] = $_POST['slcInstrumento'][$nCont];
        mysqli_stmt_bind_param(
            $oCmd,
            'iissi',
            $vDadosBanda[$nCont][0],
            $vDadosBanda[$nCont][1],
            $vDadosBanda[$nCont][2],
            $vDadosBanda[$nCont][3],
            $vDadosBanda[$nCont][4]
        );/*
        echo $vDadosBanda[$nCont][0][0],
        $vDadosBanda[$nCont][1][0],
        $vDadosBanda[$nCont][2][0],
        $vDadosBanda[$nCont][3][0],
        $vDadosBanda[$nCont][4][0];
        */
        var_dump($oCmd);
        mysqli_stmt_execute($oCmd);
        var_dump($oCmd);
    }
    mysqli_commit($conexao);
    array_push($_SESSION["bandas"], $bndNome);
}
//header('Location:../index.php');
