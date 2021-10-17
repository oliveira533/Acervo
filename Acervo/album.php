<?php
require("conexao.php");
if (isset($_GET['album']))
	$album = urldecode($_GET['album']);
else
	$album = 'Yellow Brick Road';
$sql = "SELECT ALBNOME, DATE_FORMAT(ALBDTLANCAMENTO, '%d/%m/%Y'), IFNULL(GRVNOME, 'SEM GRAVADORA'),
	IFNULL(ARTNOME,IFNULL(BDSNOME, 'Mais de 1 Criador')), GNRNOME, MDSNOME FROM ALBUNS LEFT JOIN GRAVADORAS ON ALBCODIGO = GRVCODIGO 
	LEFT JOIN GENEROS ON ALBGENERO = GNRCODIGO LEFT JOIN MIDIAS ON ALBMIDIA = MDSCODIGO LEFT JOIN ARTISTAS on ALBARTISTA = ARTCODIGO 
	LEFT JOIN BANDAS on ALBBANDA = BDSCODIGO WHERE ALBNOME LIKE '%$album%';";
	// select para trazer a gravadora, genero, midias, artista e banda de um album    
$consulta = mysqli_query($conexao, $sql);
//echo $sql;
$aDados = mysqli_fetch_array($consulta);
?>

<html>

<head>
	<title>Album: <?php echo $album; ?></title>
	<link rel="stylesheet" href="bootstrap.min.css" />
	<link rel="stylesheet" href="album.css" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<meta charset="UTF-8" />
</head>

<body>
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="
							card
							margin margin
							col-3 col-sm-3 col-md-3 col-lg-3
							descricao
						">
					<img src="#" class="card-img-top" alt="..." />
					<div class="card-body">
						<h5 class="card-title"><?php echo $album ?></h5>
						<p class="card-text margin2">Banda/Artista <br>
							<a href="<?php
										if ($aDados[3] == "Mais de 1 Criador")
											echo "#";
										else
											echo "banda.php?banda=" . urlencode($aDados[3]) ?>">
								<?php echo $aDados[3] ?>
							</a>
						</p>
						<p class="card-text margin2">Gravadora<br><?php echo $aDados[2] ?></p>
						<p class="card-text margin2">Genero <br><?php echo $aDados['GNRNOME'] ?></p>
						<p class="card-text margin2">Midia <br> <?php echo $aDados['MDSNOME'] ?></p>
						<p class="card-text margin2">data de lançamento <br> <?php echo $aDados[1] ?></p>
						<a href="index.php"><img src="https://www.svgrepo.com/show/40892/home-button.svg" alt="" width="40px" /></a>
					</div>
				</div>
				<div class="col-9 col-sm-9 col-md-9 col-lg-9 musicas">
					<div class="row">
						<div class="col-6 col-sm-6 col-md-6 col-lg-6">
							<ul>
								<h3>Musicas</h3>
								<?php
								$sql = "SELECT MSCCODIGO, MSCNOME FROM ALBUNS JOIN FAIXAS ON ALBCODIGO = FXSALBUM JOIN MUSICAS on FXSMUSICA = MSCCODIGO WHERE ALBNOME LIKE '%$album%'";
								$consulta = mysqli_query($conexao, $sql);
								while ($vReg = mysqli_fetch_assoc($consulta)) {
									echo '<li>' . $vReg['MSCNOME'] . '</li>';
										// select para trazer as musicas do album   

								}
								?>
							</ul>
						</div>
						<div class="col-6 col-sm-6 col-md-6 col-lg-6">
							<ul>
								<h3>Duração</h3>
								<?php
								$sql = "SELECT MSCCODIGO, MSCDURACAO FROM ALBUNS JOIN FAIXAS ON ALBCODIGO = FXSALBUM JOIN MUSICAS on FXSMUSICA = MSCCODIGO WHERE ALBNOME LIKE '%$album%'";
								$consulta = mysqli_query($conexao, $sql);
								while ($vReg = mysqli_fetch_assoc($consulta)) {
									echo '<li>' . $vReg['MSCDURACAO'] . '</li>';
									// select para trazer duração das musicas do album   
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
<?php
mysqli_free_result($consulta);
?>

</html>