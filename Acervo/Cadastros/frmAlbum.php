<?php
session_start();
$_SESSION['form'] = "Album";

?>
<html>

<body>
    <form action="./Cadastros/cadastrar.php" onsubmit="fnLimpa()">
        <label for="NoAl">Nome</label><input type="text" name="NoAl" id="NoAl">
        <label for="txbgravadora">Gravadora</label><select name="txbgravadora">
            <?php
            $sql = "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS ORDER BY GRVNOME";
            $consulta = mysqli_query($conexao, $sql);

            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["GRVCODIGO"] . "'>" . $vReg["GRVNOME"] . "</option>";
            }
            mysqli_free_result($consulta);
            ?>
        </select>
        <label for="txbgenero">Genero</label><select name="txbgenero">
            <?php
            $sql = "SELECT GNRCODIGO, GNRNOME FROM GENEROS ORDER BY GNRNOME";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["GNRCODIGO"] . "'>" . $vReg["GNRNOME"] . "</option>";
            }
            mysqli_free_result($consulta);
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
            mysqli_free_result($consulta);
            ?>
        </select>
        <label class="label" for="slcArtista">Artista</label><select name="slcArtista" id="slcArtista">
            <?php
            $sql = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["ARTCODIGO"] . "'>" . $vReg["ARTNOME"] . "</option>";
            }
            mysqli_free_result($consulta);
            ?>
        </select>
        <label for="txbcapa">Imagem da Capa</label><input type="file" name="txbcapa" id="txbcapa" onChange="fnExibeArq(event)">
        <label for="txbmidia">Midia</label><select name="txbmidia">
            <?php
            $sql = "SELECT MDSCODIGO, MDSNOME FROM MIDIAS ORDER BY MDSNOME";
            $consulta = mysqli_query($conexao, $sql);
            while ($vReg = mysqli_fetch_assoc($consulta)) {
                echo "<option value='" . $vReg["MDSCODIGO"] . "'>" . $vReg["MDSNOME"] . "</option>";
            }
            mysqli_free_result($consulta);
            ?>
        </select>
        <img id="imgPreVis" style="border: solid; width: 50px; height: 50px;" name="txtArquivo">

        <section>

            <table>
                <tbody id="oMusicas">
                    <tr id="oLinhaMusica">
                        <td> <input type="hidden" name="txtCodMusica[]" value="0"> </td>
                        <td> <input name="txtNomeMusica[]" value=""> </td>
                        <td> <input type="time" name="txtDurMusca[]" value="00:00"> </td>
                        <td> <textarea name="txaLetraMusica[]"> </textarea> </td>
                        <td> <input type="link" name="txtVideoMusica[]" value=""> </td>
                        <td> <input type="link" name="txtAudioMusica[]" value=""> </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td coldspan="6"><button type="button" onclick="fnDuplicaMusica()">Incluir Músicas</button></td>
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

        function fnExibeArq(oEvt) {
            let oArq = new FileReader();
            oArq.onload = function() {
                document.getElementById('imgPreVis').src = oArq.result;
            }
            oArq.readAsDataURL(oEvt.target.files[0]);
        }

        function fnDuplicaMusica() {
            let cCampos = document.getElementById('oLinhaMusica').innerHTML;

            document.getElementById('oMusicas').insertAdjacentHTML('beforeEnd', cCampos);
        }
    </script>
</body>

</html>