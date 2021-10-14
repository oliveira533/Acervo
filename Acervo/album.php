<?php
$conexao = mysqli_connect("localhost", "root", '', "acervo");
if (isset($_GET['album']))
	$album = $_GET['album'];
else
	$album = 'Yellow Brick Road';
$sql = "SELECT ALBNOME, DATE_FORMAT(ALBDTLANCAMENTO, '%d/%m/%Y'), GRVNOME, GNRNOME, MDSNOME FROM ALBUNS JOIN gravadoras ON ALBCODIGO = 
GRVCODIGO JOIN generos ON ALBGENERO = GNRCODIGO JOIN midias ON ALBMIDIA = MDSCODIGO WHERE ALBNOME LIKE '%$album%'";
$consulta = mysqli_query($conexao, $sql);
$aDados = mysqli_fetch_array($consulta);
?>

<html>

<head>
	<title>Album: <?php echo $album; ?></title>
	<link rel="stylesheet" href="bootstrap.min.css" />
	<link rel="stylesheet" href="album.css" />
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
						" style="background: #00022e; color: #fff">
					<img src="#" class="card-img-top" alt="..." />
					<div class="card-body">
						<h5 class="card-title"><?php echo $album ?></h5>
						<p class="card-text margin2">Gravadora<br><?php echo $aDados['GRVNOME'] ?></p>
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
								$sql = "SELECT MSCCODIGO, MSCNOME FROM albuns JOIN faixas ON ALBCODIGO = FXSALBUM JOIN musicas on FXSMUSICA = MSCCODIGO WHERE ALBNOME LIKE '%$album%'";
								$consulta = mysqli_query($conexao, $sql);
								while ($vReg = mysqli_fetch_assoc($consulta)) {
									echo '<li>' . $vReg['MSCNOME'] . '</li>';
								}
								?>
							</ul>
						</div>
						<div class="col-6 col-sm-6 col-md-6 col-lg-6">
							<ul>
								<h3>Duração</h3>
								<?php
								$sql = "SELECT MSCCODIGO, MSCDURACAO FROM albuns JOIN faixas ON ALBCODIGO = FXSALBUM JOIN musicas on FXSMUSICA = MSCCODIGO WHERE ALBNOME LIKE '%$album%'";
								$consulta = mysqli_query($conexao, $sql);
								while ($vReg = mysqli_fetch_assoc($consulta)) {
									echo '<li>' . $vReg['MSCDURACAO'] . '</li>';
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

</html>