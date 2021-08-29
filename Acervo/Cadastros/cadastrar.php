<?php
    
    session_start();
    $oForm = $_SESSION['form'];

    $oCon = mysqli_connect("localhost","Aluno2DS","SenhaBD2","ACERVO");
    $oQuery;

    if($oForm == "Genero"){
        $oGenNome = $_GET['txbNome'];
        $oGenDesc = $_GET['txadesc'];
        $oQuery = "INSERT INTO GENEROS (GNRNOME, GNRDESCRICAO) VALUES ('".$oGenNome."', '".$oGenDesc."')";
        echo($oQuery);
        //mysqli_query($oCon ,$oQuery);
        
    }
    else if($oForm == "Album"){
        $oAlbNome = $_GET['NoAl'];
        $oAlbGrav = $_GET['txbgravadora'];
        $oAlbGen = $_GET['txbgenero'];
        $oAlbDtLanc = $_GET['TxbDatadeLancamento'];
        $oAlbBanda = $_GET['txbBanda'];
        $oAlbArtista = $_GET['txbArtista'];
        $oAlMidia = $_GET['txbmidia'];

        if($oAlbBanda == ""){
            $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('".$oAlbNome."','".$oAlbGrav."', '".$oAlbGen."', '".$oAlbDtLanc."', '".$oAlbArtista."','".$oAlMidia."')";
            echo($oQuery);
            //mysqli_query($oCon ,$oQuery);
        }
        else {
            $oQuery = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('".$oAlbNome."','".$oAlbGrav."', '".$oAlbGen."', '".$oAlbDtLanc."', '".$oAlbBanda."','".$oAlMidia."')";
            echo($oQuery);
            //mysqli_query($oCon ,$oQuery);
            
        }
    }
    else if($oForm == "Insturmento"){
        $oInsNome = $_GET['txbNome'];
        $oInsTipo = $_GET['slcTipo'];

        $oQuery = "INSERT INTO INSTRUMNENTOS (INSNOE, INSTIPO) VALUES ('".$oInsNome."', ".$oInsTipo.")";
        echo($oQuery);
        //mysqli_query($oCon ,$oQuery);
            
    }
    else if($oForm == "Midia"){
        $oMdsNome = $_GET['txbNome'];
        $oMdsOnline = $_GET['Online'];

        if($oMdsOnline == "on"){
            $oMdsOnline = 1;
            $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('".$oMdsNome."'. 0)";
            echo"on";
            //mysqli_query($oCon ,$oQuery);
        }
        else{
            $oMdsOnline = 0;
            $oQuery = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('".$oMdsNome."'. 1)";
            echo"off";
            //mysqli_query($oCon ,$oQuery);
        }
    }
    else if( $oForm == "Gravadora"){
        $grvNome = $_GET['txbNome'];
        $grvInin = $_GET['TxbInicio'];
        $grvFim = $_GET['TxbFinal'];

        $oQuery = "INSERT INTO GRAVADORAS (GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES ('".$grvNome."','".$grvInin."','".$grvFim."')";
        echo($oQuery);
        //mysqli_query($oCon ,$oQuery);
    }
?>





