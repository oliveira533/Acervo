<?php
session_start();
var_dump($_SESSION["artistas"]);
var_dump($_SESSION["bandas"]);
var_dump($_SESSION["albuns"]);
?>
<html>

<head>
    <link rel="stylesheet" href="usuario.css">
    <title><?php echo $_SESSION["USRNOME"] ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
</head>

<body>
    <main>

        <nav class="menu aaa">
            <ul>
                <li><a href="#" style="color: #333;"><img class="imgusu" src="<?php echo "https://avatars.dicebear.com/api/gridy/" . $_SESSION["USRNOME"] . ".svg"; ?>"></a></li>
                <li><a href=" cadastro.php"><button>Inserir conteúdo</button></a></li>
            </ul>
        </nav>
        <div class="Banda tudo">
            <label class="Titulo">Ultimas bandas/artistas que você cadastrou</label>
            <div class='cards'>
                <?php
                require("conexao.php");
                $sql = "SELECT ARTNOME FROM ARTISTAS WHERE ARTNOME LIKE ";
                $nCont = 0;
                foreach ($_SESSION["artistas"] as $artista) {
                    if ($nCont <= 4) {
                        $consulta = mysqli_query($conexao, $sql . "\"" . $artista . "\"");
                        echo "                
                        <div class='card'>
                        <label>" . mysqli_fetch_assoc($consulta)["ARTNOME"] . "</label>
                        </div>";
                    }
                    $nCont++;
                }
                $sql = "SELECT BDSNOME FROM BANDAS WHERE BDSNOME LIKE ";
                foreach ($_SESSION["bandas"] as $bandas) {
                    if ($nCont <= 4) {
                        $consulta = mysqli_query($conexao, $sql . "\"" . $bandas . "\"");
                        echo  $sql . "\"" . $bandas . "\"";
                        echo "                
                        <div class='card'>
                        <label>" . mysqli_fetch_assoc($consulta)["BDSNOME"] . "</label>
                        </div>";
                    }
                    $nCont++;
                }
                ?>
            </div>
        </div>
        <div class="Album tudo">
            <label class="Titulo">Ultimas albuns que você cadastrou</label>
            <div class="cards">
                <?php
                require("conexao.php");
                $sql = "SELECT ALBNOME FROM ALBUNS WHERE ALBNOME LIKE ";
                $nCont = 0;
                foreach ($_SESSION["albuns"] as $albuns) {
                    if ($nCont <= 4) {
                        $consulta = mysqli_query($conexao, $sql . "'" . $albuns . "'");
                        echo "                
                        <div class='card'>
                        <label>" . mysqli_fetch_assoc($consulta)["ALBNOME"] . "</label>
                        </div>";
                    }
                    $nCont++;
                }

                ?>
            </div>
        </div>
    </main>
    <a href="index.php">
        <img class="imghome" src="./images/home.png">
    </a>
</body>

</html>