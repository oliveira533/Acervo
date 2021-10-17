<?php

session_start();
$oForm = $_SESSION['form'];
require("../conexao.php");

$nQtd = 0;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    mysqli_commit($conexao);

    //esse if faz um insert na tabela genero 
} else if ($oForm == "Album") {
    $oAlbNome = $_GET['NoAl'];
    $oAlbGrav = $_GET['txbgravadora'];
    $oAlbGen = $_GET['txbgenero'];
    $oAlbDtLanc = $_GET['TxbDatadeLancamento'];
    $oAlbBanda = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : (isset($_GET['slcArtista']) ? $_GET['slcArtista'] : '');
    $oAlMidia = $_GET['txbmidia'];
    $oAlbArtista = isset($_GET['slcBanda']) ? $_GET['slcBanda'] : (isset($_GET['slcArtista']) ? $_GET['slcArtista'] : '');
    //esse else if verifica se o check da banda ou artista esta marcado 
    if (isset($_FILES['txbcapa'])) {
        move_uploaded_file($_FILES['txbcapa']['tmp_name'], $_FILES['txbcapa']['name']);
        //ele faz upload da img da capa e do nome dessa img
    }
    if ($oAlbBanda == "") {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbArtista . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
        //faz insert n tabela abuns com um artista
    } else {
        $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('" . $oAlbNome . "','" . $oAlbGrav . "', '" . $oAlbGen . "', '" . $oAlbDtLanc . "', '" . $oAlbBanda . "','" . $oAlMidia . "')";
        mysqli_query($conexao, $oQuery);
        //faz insert n tabela abuns com uma banda

    }
    $nCodgAlbum = mysqli_insert_id($conexao);

    $nQtd = count($_GET['txtNomeMusica']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    // preparando um comando insert para a tabela musicas
    $vDadosMusica[] = array();

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
    // preparando um comando insert para a tabela faixas
    for ($nCont = 0; $nCont < $nQtd; $nCont++) {
        mysqli_stmt_bind_param($oCmd, 'iii', $nCodgAlbum, $vCodMusica[$nCont], $nCont);
        mysqli_stmt_execute($oCmd);
    }
    mysqli_commit($conexao);
} else if ($oForm == "Instrumento") {
    $oInsNome = $_GET['txbNome'];
    $oInsTipo = $_GET['slcTipo'];

    $oQuery = "INSERT INTO INSTRUMENTOS (INSNOME, INSTIPO) VALUES ('" . $oInsNome . "', " . $oInsTipo . ")";
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);
    // insert na tabela instrumentos
} else if ($oForm == "Midia") {
    $oMdsNome = $_GET['txbNome'];
    $oMdsOnline = isset($_GET['Online']) ? $_GET['Online'] : 'off';

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
    $grvNome = $_GET['txbNome'];
    $grvInin = $_GET['txbInicio'];
    $grvFim = $_GET['txbFinal'];

    $oQuery = "INSERT INTO GRAVADORAS (GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES ('" . $grvNome . "','" . $grvInin . "','" . $grvFim . "')";
    if (mysqli_query($conexao, $oQuery)) {
        echo "pinto";
    } else
        echo "porra";
    echo $oQuery;
    mysqli_commit($conexao);

    // insert de gravadoras
} else if ($oForm == "Artista") {
    $artNome = $_GET['txbNome'];
    $artInicio = $_GET['txbInicio'];
    $artFim = $_GET['txbFinal'];
    $artDesc = $_GET['txaAtrdesc'];

    $oQuery = "INSERT INTO ARTISTAS (ARTNOME, ARTDTINICIO, ARTDTTERMINO, ARTAPRESENTACAO) VALUES ('" . $artNome . "', '" . $artInicio . "', '" . $artFim . "', '" . $artDesc . "')";
    mysqli_query($conexao, $oQuery);
    mysqli_commit($conexao);
} else if ($oForm == "Banda") {
    mysqli_begin_transaction($conexao);

    $bndNome = $_GET['txbNome'];
    $bndInicio = $_GET['txbInicio'];
    $bndFim = isset($_GET['TxbFinal']) ? $_GET['TxbFinal'] : null;;
    $bndDesc = $_GET['txaBDdesc'];
    $oQuery = "INSERT INTO BANDA (BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES ('" . $bndNome . "', '" . $bndInicio . "', '" . $bndFim . "', '" . $bndDesc . "')";
    mysqli_query($conexao, $oQuery);
    // insert de bandas
    $nArtis = count($_GET['slcArtista']);

    $oCmd = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($oCmd, "INSERT INTO INTEGRANTES(ITGBANDA, ITGARTISTA, ITGDTINICIO, ITGDTTERMINO, ITGINSTRUMENTO) VALUES (?, ?, ?, ?, ?)");
    // insert de integrantes da banda
    $nCodBanda = mysqli_insert_id($conexao);

    $vDadosBanda[] = array();
    echo 'caiu aqui';

    for ($nCont = 0; $nCont < $nArtis; $nCont++) {

        $vDadosBanda[$nCont][] = $nCodBanda;
        $vDadosBanda[$nCont][] = $_GET['slcArtista'][$nCont];

        $vDadosBanda[$nCont][] = isset($_GET['txtFim']) ? $_GET['txtFim'] : null;
        $vDadosBanda[$nCont][] = isset($_GET['txtFim']) ? $_GET['txtFim'] : null;

        $vDadosBanda[$nCont][] = $_GET['slcInstrumento'][$nCont];
        mysqli_stmt_bind_param($oCmd, 'iissi', ...$vDadosBanda[$nCont]);

        mysqli_stmt_execute($oCmd);

        var_dump($oCmd);
    }
    mysqli_commit($conexao);
}
//header('Location:../index.php');