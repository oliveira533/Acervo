<?php
    session_start();
    $conexao = mysqli_connect("localhost","Aluno2DS","SenhaBD2","ACERVO");
    $_SESSION['form'] = "Musica";
    ?>   

<html>
    <body>
        <head>
        <link rel="stylesheet" href="frmMusica.css">
        </head>
        <form action="cadastrar.php">
            <div>
                <label>Nome da música</label>
                <input placeholder="Nome da música" name="txbNome"><br/>
                <label>Duração</label>
                <input placeholder="HH/MM/SS"><br/>
                <label for="txbGenero">Genero</label><select name="txbGenero">
                <?php
                $sql = "SELECT GNRCODIGO, GNRNOME FROM GENEROS";
                $consulta = mysqli_query($conexao, $sql);
                while($vReg = mysqli_fetch_assoc($consulta)){
                echo"<option value='". $vReg["GNRCODIGO"] ."'>". $vReg["GNRNOME"] ."</option>";
                }
                ?>   
                </select><br>
                <label for="txbBanda">Banda</label><select name="txbBanda">
                <?php
                $sql = "SELECT BDSCODIGO, BDSNOME FROM BANDAS";
                $consulta = mysqli_query($conexao, $sql);
                while($vReg = mysqli_fetch_assoc($consulta)){
                echo"<option value='". $vReg["BDSCODIGO"] ."'>". $vReg["BDSNOME"] ."</option>";
                }
                ?>   
                </select><br>
                <label for="txbArtista">Artista</label><select name="txbArtista">
                <?php
                $sql = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS";
                $consulta = mysqli_query($conexao, $sql);
                while($vReg = mysqli_fetch_assoc($consulta)){
                echo"<option value='". $vReg["ARTCODIGO"] ."'>". $vReg["ARTNOME"] ."</option>";
                }
                ?>   
                </select><br>
                <label>Letra</label>
                <textarea></textarea>
            </div>
        </form>
    </body>
</html>