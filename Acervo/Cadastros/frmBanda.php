<?php
session_start();
$_SESSION['form'] = "Banda";
?>
<html>

<body>
    <form action="./Cadastros/cadastrar.php">
        <label for="txbNome">Nome</label><input type="text" name="txbNome" id="txbNome"><br>
        <label for="TxbInicio">Data de Inicio da Banda</label><input type="date" name="txbInicio">
        <label for="TxbFinal">Data de Termino da Banda</label><input type="date" name="txbFinal">
        <label for="txaBDdesc">Descrição da Banda</label><textarea id="txaBDdesc" name="txaBDdesc"> </textarea><br>
        <section>

            <table>
                <tbody id="oMusicas">
                    <tr id="oLinhaMusica">
                        <td>
                            <select name="slcArtista[]" id="slcArtista">
                            <?php
                            $sql = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS";
                            $consulta = mysqli_query($conexao, $sql);
                            while ($vReg = mysqli_fetch_assoc($consulta)) {
                                echo "<option value='" . $vReg["ARTCODIGO"] . "'>" . $vReg["ARTNOME"] . "</option>";
                            }
                            mysqli_free_result($consulta);
                            ?>
                            </select>
                        </td>
                        <td> <input type="date" name="txtInicio[]" value="00:00"> </td>
                        <td> <input type="date" name="txtFim[]" value="00:00"> </td>
                        <td>
                            <select name="slcInstrumento[]" id="slcArtista">
                                <?php
                                $sql = "SELECT INSNOME, INSCODIGO FROM INSTRUMENTOS";
                                $consulta = mysqli_query($conexao, $sql);
                                while ($vReg = mysqli_fetch_assoc($consulta)) {
                                    echo "<option value='" . $vReg["INSCODIGO"] . "'>" . $vReg["INSNOME"] . "</option>";
                                }
                                mysqli_free_result($consulta);
                                ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td coldspan="6"><button type="button" onclick="fnDuplicaMusica()">Incluir Integrante</button></td>
                    </tr>
                </tfoot>
            </table>
        <button type="submit">Cadastrar</button>
    </form>

    <script>
        function fnDuplicaMusica() {
            let cCampos = document.getElementById('oLinhaMusica').innerHTML;

            document.getElementById('oMusicas').insertAdjacentHTML('beforeEnd', cCampos);
        }
    </script>
</body>
</html>