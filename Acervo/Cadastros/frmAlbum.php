<?php
session_start();
$_SESSION['form'] = "Album";
?>
<html>

<body>
    <form action="./Cadastros/cadastrar.php" onsubmit="fnLimpa()">
        <label for="NoAl">Nome</label><input type="text" name="NoAl" id="NoAl">
        <label fro="txbgravadora">Gravadora</label><select name="txbgravadora">
            <?php

            $conexao = mysqli_connect("localhost", "root", '', "acervo");

            $sql = "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS ORDER BY GRVNOME";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["GRVCODIGO"] . "'>" . $vReg["GRVNOME"] . "</option>";
            }
            var_dump($conexao);
            ?>
        </select>
        <label for="txbgenero">Genero</label><select name="txbgenero">
            <?php
            $sql = "SELECT GNRCODIGO, GNRNOME FROM GENEROS ORDER BY GNRNOME";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["GNRCODIGO"] . "'>" . $vReg["GNRNOME"] . "</option>";
            }
            ?>
        </select>
        <label for="TxbDatadeLancamento">Data de Lançamento</label><input type="date" name="TxbDatadeLancamento">
        <label for="col">Coletanêa</label><input class="radio" type="radio" name="rdbCriador" id="col" onchange="fnCheca()" checked>
        <label for="art">Artista</label><input class="radio" type="radio" name="rdbCriador" id="art" onchange="fnCheca()">
        <label for="band">Banda</label><input class="radio" type="radio" name="rdbCriador" id="band" onchange="fnCheca()">
        <br>
        <label class="label" for="slcBanda">Banda</label><select name="slcBanda" id="slcBanda">
            <?php
            $sql = "SELECT BDSCODIGO, BDSNOME FROM BANDAS";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["BDSCODIGO"] . "'>" . $vReg["BDSNOME"] . "</option>";
            }
            ?>
        </select>
        <label class="label" for="slcArtista">Artista</label><select name="slcArtista" id="slcArtista">
            <?php
            $sql = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["ARTCODIGO"] . "'>" . $vReg["ARTNOME"] . "</option>";
            }
            ?>
        </select>
        <label for="txbcapa">Imagem da Capa</label><input type="file" name="txbcapa" id="txbcapa">
        <label for="txbmidia">Midia</label><select name="txbmidia">
            <?php
            $sql = "SELECT MDSCODIGO, MDSNOME FROM MIDIAS ORDER BY MDSNOME";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["MDSCODIGO"] . "'>" . $vReg["MDSNOME"] . "</option>";
            }
            ?>
        </select>
        <section>
            <table>
                <tbody id="objMusicas">
                    <tr id="objLinhaMusica">
                        <td><input type="hidden" name="txbCodMusica[]" value="0" /></td>
                        <td><label for="txbNomeMusica[]">Nome da Musica</label><input name="txbNomeMusica[]" value="" /></td>
                        <td><label for="txbDuracaoMusica[]">Duração da Musica</label><input type="time" name="txbDuracaoMusica[]" value="00:00" /></td>
                        <td><label for="txbLetraMusica[]">Letra da Musica</label><textarea name="txbLetraMusica[]"></textarea></td>
                        <td><label for="txbVideoMusica[]">Link do Video da Musica</label><input type="link" name="txbVideoMusica[]" value="" /></td>
                        <td><label for="txbAudioMusica[]">Link do Audio da Musica</label><input type="link" name="txbAudioMusica[]" value="" /></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan=6>
                            <button type="button" onClick="fnDuplicarMusica()">Incluir música</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
    </form>
    <script>
        const oRadio = document.getElementsByName("rdbCriador"),
            oBanda = document.getElementById("slcBanda"),
            oArtista = document.getElementById("slcArtista"),
            oLabels = document.getElementsByClassName("label");
        oArtista.style.display = "none";
        oBanda.style.display = "none";
        oLabels[0].style.display = "none";
        oLabels[1].style.display = "none";

        function fnCheca() {
            if (oRadio[0].checked) {
                oArtista.style.display = "none";
                oBanda.style.display = "none";
                oLabels[0].style.display = "none";
                oLabels[1].style.display = "none";
            } else if (oRadio[1].checked) {
                oArtista.style.display = "block";
                oBanda.style.display = "none";
                oLabels[0].style.display = "none";
                oLabels[1].style.display = "block";
            } else if (oRadio[2].checked) {
                oArtista.style.display = "none";
                oBanda.style.display = "block";
                oLabels[0].style.display = "block";
                oLabels[1].style.display = "none";
            }
        }

        function fnLimpa() {
            if (oRadio[0].checked) {
                oArtista.value = "";
                oBanda.value = "";
            }
            if (oRadio[1].checked)
                oBanda.value = "";
            if (oRadio[2].checked)
                oArtista.value = "";
        }

        function fnDuplicarMusica() {
            let cCampos = document.getElementById('objLinhaMusica').innerHTML;
            document.getElementById('objMusicas').insertAdjacentHTML('beforeEnd', cCampos);
        }
    </script>
</body>

</html>