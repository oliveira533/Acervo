<?php
session_start();

$oCon = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'ACERVO');

echo '<!-- VARIAVEL GET';
var_dump($_GET);
echo '-->';


//VERIFICA SE O USUARIO CLICOU NO BOTAO GRAVAR
if(isset($_GET['txtCodigo']))
{
	//ABRE UMA TRANSACAO NA BASE DE DADOS
	mysqli_begin_transaction($oCon);
	
	//PREPARA O COMANDO PARA EXECUTAR NA BASE DE DADOS
	$oCmd = mysqli_stmt_prepare($oCon, "INSERT INTO ALBUNS (ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBARTISTA, ALBCAPA, ALBMIDIA) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	
	//PREENCHER OS VALORES DE CADA CAMPO
	$cCapa = null;
	mysqli_stmt_bind_param($oCmd, "siisiisi", $_GET['txtNome'], $_GET['cmbGravadora'], $_GET['cmbGenero'], $_GET['txtLancamento'], $_GET['cmbBanda'], $_GET['cmbArtista'], $cCapa, $_GET['cmbMidia']);
	
	//ENVIAR A INSTRUCAO PARA A BASE DE DADOS
	mysqli_stmt_execute($oCmd);
	
	echo 'PASSEI PELA GRAVACAO';
	echo mysqli_error($oCon);
	
	//ENCERRA A TRANSACAO, DESFAZENDO TODAS AS ACOES
	mysqli_commit($oCon);
	
}
?>

<html>

<head>
	<title>Cadastro de álbuns</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="?" />
</head>

<body>

	<form>
		<input type="hidden" name="txtCodigo" value="0" />
		<label>
			<span>Título</span>
			<input name="txtTitulo" value="" />
		</label>
		<label>
			<span>Gravadora</span>
			<select name="cmbGravadora">
				<option value="">(selecione uma gravadora)</option>
				<?php
				$cSQL = "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS ORDER BY GRVNOME";
				$oDados = mysqli_query($oCon, $cSQL);
				
				while($oReg = mysqli_fetch_assoc($oDados))
					echo '<option value="' . $oReg['GRVCODIGO'] . '">' . $oReg['GRVNOME'] . '</option>';
				
				mysqli_free_result($oDados);
				?>
			</select>
		</label>
		<label>
			<span>Gênero musical</span>
			<select name="cmbGenero">
				<option value="">(selecione um gênero)</option>
				<?php
				$cSQL = "SELECT GNRCODIGO, GNRNOME FROM GENEROS ORDER BY GNRNOME";
				$oDados = mysqli_query($oCon, $cSQL);
				
				while($oReg = mysqli_fetch_assoc($oDados))
					echo '<option value="' . $oReg['GNRCODIGO'] . '">' . $oReg['GNRNOME'] . '</option>';
				
				mysqli_free_result($oDados);
				?>
			</select>
		</label>
		<label>
			<span>Data de lançamento</span>
			<input type="date" name="txtLancamento" />
		</label>
		<label>
			<label><input type="radio" name="radTipo" value=0 CHECKED /><span>Coletânea</span></label>
			<label><input type="radio" name="radTipo" value=1 /><span>Artista solo / Cantor(a)</span></label>
			<label><input type="radio" name="radTipo" value=2 /><span>Duplas, grupos ou bandas</span></label>
		</label>
		<label>
			<span>Artista solo / cantor(a)</span>
			<select name="cmbArtista">
				<option value="">(selecione um artista)</option>
				<?php
				$cSQL = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS ORDER BY ARTNOME";
				$oDados = mysqli_query($oCon, $cSQL);
				
				while($oReg = mysqli_fetch_assoc($oDados))
					echo '<option value="' . $oReg['ARTCODIGO'] . '">' . $oReg['ARTNOME'] . '</option>';
				
				mysqli_free_result($oDados);
				?>
			</select>
		</label>
		<label>
			<span>Dupla, grupo ou banda</span>
			<select name="cmbBanda">
				<option value="">(selecione uma banda)</option>
				<?php
				$cSQL = "SELECT BDSCODIGO, BDSNOME FROM BANDAS ORDER BY BDSNOME";
				$oDados = mysqli_query($oCon, $cSQL);
				
				while($oReg = mysqli_fetch_assoc($oDados))
					echo '<option value="' . $oReg['BDSCODIGO'] . '">' . $oReg['BDSNOME'] . '</option>';
				
				mysqli_free_result($oDados);
				?>
			</select>
		</label>
		<label>
			<span>Mídia do álbum</span>
			<select name="cmbMidia">
				<option value="">(selecione uma mídia)</option>
				<?php
				$cSQL = "SELECT MDSCODIGO, MDSNOME FROM MIDIAS ORDER BY MDSNOME";
				$oDados = mysqli_query($oCon, $cSQL);
				
				while($oReg = mysqli_fetch_assoc($oDados))
					echo '<option value="' . $oReg['MDSCODIGO'] . '">' . $oReg['MDSNOME'] . '</option>';
				
				mysqli_free_result($oDados);
				?>
			</select>
		</label>
		<section>
			<table>
				<tbody id="objMusicas">
					<tr id="objLinhaMusica">
						<td><input type="hidden" name="txtCodMusica[]" value="0" /></td>
						<td><input name="txtNomeMusica[]" value="" /></td>
						<td><input type="time" name="txtDuracaoMusica[]" value="00:00" /></td>
						<td><textarea name="txtLetraMusica[]"></textarea></td>
						<td><input type="link" name="txtVideoMusica[]" value="" /></td>
						<td><input type="link" name="txtAudioMusica[]" value="" /></td>
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
		
		<button> Gravar álbum </button>
		
	</form>

</body>

<script>
function fnDuplicarMusica()
{
	let cCampos = document.getElementById('objLinhaMusica').innerHTML;
	
	document.getElementById('objMusicas').insertAdjacentHTML('beforeEnd', cCampos);
}
</script>


</html>