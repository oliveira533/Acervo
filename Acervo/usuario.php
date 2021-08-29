<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="usuario.css"> 
        <title><?php echo $_SESSION["USRNOME"]?></title>
        <meta charset="UTF-8"> 
    </head>
    <body>
        <nav class="menu aaa">
            <ul>
                <li><a href="#" style="color: #333;"><img class="imgusu"src="#"></a></li>
                <li><a href="cadastro.php" style="color: #333;"><button>Inserir conteúdo</button></a></li>
                <li><a href="https://c.tenor.com/MhIARALUqvAAAAAd/ednaldo-pereira-vale-nada.gif" style="color: #333;"><button>Alterar dados</button></a></li>
            </ul>
        </nav>
        <div class="Musica tudo">
            <label class="Titulo">Músicas que você cadastrou</label><br>
            <div class="card">
                <img class="imgbox" src="#"><br>
                <label>Musica</label>
            </div>        
        </div>
        <div class="Banda tudo">
            <label class="Titulo">Bandas que você cadastrou</label><br>
            <div class="card">
                <img class="imgbox" src="#"><br>
                <label>Banda</label>
            </div>        
        </div>
        <div class="Album tudo">
            <label class="Titulo">Albuns que você cadastrou</label><br>
            <div class="card">
                <img  class="imgbox"src="#">
                <label>Album</label>
            </div>        
        </div>
        <a href="index.php">
			<img class="imghome"src="./images/home.png" >
		</a>
    </body>
</html>