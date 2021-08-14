<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="cadastro.css" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Cadastrar Dados</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cadastro</title>
    </head>

    <body>
        <main>
            <nav>
                Escolha o que você quer inserir:
                <select name="slcInserir" id="slcInserir" onchange="fnReload()">
                    <option class="options" value="banda">Banda</option>
                    <option class="options" value="artista">Artista</option>
                    <option class="options" value="genero">Genero</option>
                    <option class="options" value="musica">Musica</option>
                    <option class="options" value="album">Album</option>
                    <option class="options" value="gravadora">Gravadora</option>
                    <option class="options" value="instrumentos">Instrumentos</option>
                    <option class="options" value="Midias">Midias</option>
                </select>
            </nav>
            <div>
                <?php 
                    include("./Cadastros/frmGenero.php");
                ?>
            </div>
        </main>
    </body>

    <script>
        const options = document.getElementsByClassName("options"),
            select = document.getElementById("slcInserir");
        function fnReload(){
            for(let i =0;i<options.length;i++){
                options[i].selected ? alert(options[i].text) : 0;
            }
        }
    </script>
</html>
