<?php
session_start();
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
                <li><a href="https://c.tenor.com/MhIARALUqvAAAAAd/ednaldo-pereira-vale-nada.gif"><button>Alterar dados</button></a></li>
            </ul>
        </nav>
        <div class="Musica tudo">
            <label class="Titulo">Músicas que você cadastrou</label>
            <div class="cards">
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Musica</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Musica</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Musica</label>
                </div>

            </div>
        </div>
        <div class="Banda tudo">
            <label class="Titulo">Bandas que você cadastrou</label>
            <div class="cards">
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Banda</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Banda</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#"><br>
                    <label>Banda</label>
                </div>
            </div>
        </div>
        <div class="Album tudo">
            <label class="Titulo">Albuns que você cadastrou</label>
            <div class="cards">
                <div class="card">
                    <img class="imgbox" src="#">
                    <label>Album</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#">
                    <label>Album</label>
                </div>
                <div class="card">
                    <img class="imgbox" src="#">
                    <label>Album</label>
                </div>

            </div>
        </div>
    </main>
    <a href="index.php">
        <img class="imghome" src="./images/home.png">
    </a>
</body>

</html>