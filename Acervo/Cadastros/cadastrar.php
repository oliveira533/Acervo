<?php
    
    session_start();
    $oForm = $_SESSION['form'];

    $oCon = mysqli_connect("localhost","Aluno2DS","SenhaBD2","ACERVO");
    $oQuerry;

    if($oForm == "Genero"){
        $oGenNome = $_GET['txbNome'];
        $oGenDesc = $_GET['txadesc'];
        $oQuerry = "INSERT INTO GENEROS (GNRNOME, GNRDESCRICAO) VALUES ('".$oGenNome."', '".$oGenDesc."')";
        echo($oQuerry);
        //mysqli_query($oCon ,$oQuerry);
        
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
            $oQuerry = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES ('".$oAlbNome."','".$oAlbGrav."', '".$oAlbGen."', '".$oAlbDtLanc."', '".$oAlbArtista."','".$oAlMidia."')";
            echo($oQuerry);
            //mysqli_query($oCon ,$oQuerry);
        }
        else {
            $oQuerry = "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES ('".$oAlbNome."','".$oAlbGrav."', '".$oAlbGen."', '".$oAlbDtLanc."', '".$oAlbBanda."','".$oAlMidia."')";
            echo($oQuerry);
            //mysqli_query($oCon ,$oQuerry);
            
        }
    }
    else if($oForm == "Insturmento"){
        $oInsNome = $_GET['txbNome'];
        $oInsTipo = $_GET['slcTipo'];

        $oQuerry = "INSERT INTO INSTRUMNENTOS (INSNOE, INSTIPO) VALUES ('".$oInsNome."', ".$oInsTipo.")";
        echo($oQuerry);
        //mysqli_query($oCon ,$oQuerry);
            
    }
    else if($oForm == "Midia"){
        $oMdsNome = $_GET['txbNome'];
        $oMdsOnline = $_GET['Online'];

        if($oMdsOnline == "on"){
            $oMdsOnline = 1;
            $oQuerry = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('".$oMdsNome."'. ".$oMdsOnline.")";
            echo"on";
        }
        else{
            $oMdsOnline = 0;
            $oQuerry = "INSERT INTO MIDIAS (MDSNOME, MDSONLINE) VALUES ('".$oMdsNome."'. ".$oMdsOnline.")";
            echo"off";
        }
    }
?>





