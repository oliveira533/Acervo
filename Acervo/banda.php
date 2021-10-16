<?php
require("conexao.php");
if (isset($_GET['banda']))
	$banda = urldecode($_GET['banda']);
else
	$banda = 'Elton john';
$sql = "SELECT IF('$banda' LIKE BDSNOME,'BANDA','ARTISTA') opcao FROM bandas";
$consulta = mysqli_query($conexao, $sql);
$bIsBanda = false;
while ($vReg = mysqli_fetch_assoc($consulta)) {
	if ($vReg["opcao"] == "BANDA")
		$bIsBanda = true;
}
mysqli_free_result($consulta);
$sql = $bIsBanda ? "SELECT * FROM BANDAS WHERE BDSNOME LIKE '%$banda%'" : "SELECT * FROM ARTISTAS WHERE ARTNOME LIKE '%$banda%'";
$consulta = mysqli_query($conexao, $sql);
$aDados = mysqli_fetch_array($consulta);
mysqli_free_result($consulta);
?>
<html>

<head>
	<link rel="stylesheet" href="banda.css" />
	<title><?php echo $bIsBanda ? "Banda: " : "Artista: ";
			echo $banda ?></title>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>

<body>
	<section>
		<div class="esquerda">
			<img src="#" class="imgbanda" />
			<nav>
				<h5><?php echo $banda ?></h5>
				<p>
					inicio da banda: <?php echo $aDados[2] ?> <br />
					fim da banda: <?php echo is_null($aDados[3]) ? "Ainda atua atualmente." : $aDados[3]  ?>
				</p>
				<p>
					<?php
					echo $aDados[4]
					?>
				</p>
			</nav>
		</div>
		<div class="direita">
			<article>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
				<a class="disco"><img src="#" /> </a>
			</article>
			<?php if ($bIsBanda) { ?>
				<footer>
					<header>Integrantes</header>
					<div class="pintegre"><?php
											$sql = "SELECT ARTNOME FROM INTEGRANTES JOIN BANDAS ON ITGBANDA = BDSCODIGO JOIN artistas ON ITGARTISTA = ARTCODIGO WHERE ITGBANDA = " . $aDados[0];
											$consulta = mysqli_query($conexao, $sql);
											while ($vReg = mysqli_fetch_assoc($consulta))
												echo $vReg["ARTNOME"] . "</br>"
											?></div>
				</footer> <?php } ?>
		</div>
		</a>
	</section>
	<a class="btn-home" href="index.php"><img class="img-home" src="https://www.svgrepo.com/show/40892/home-button.svg" />
</body>

</html>