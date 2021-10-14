<?php
error_reporting(0);
session_start();
require("conexao.php");
$bLogin = isset($_SESSION['USRCODIGO']);
$nMaxAlbuns = (int)mysqli_fetch_assoc(mysqli_query($conexao, "SELECT ALBCODIGO FROM ALBUNS ORDER BY ALBCODIGO DESC"))['ALBCODIGO'];
$nMaxGeneros = (int)mysqli_fetch_assoc(mysqli_query($conexao, "SELECT GNRCODIGO FROM GENEROS ORDER BY GNRCODIGO DESC"))['GNRCODIGO'];
?>

<html>

<head>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="inicio.css" />
	<title>Acervo: Banana de Calcinha</title>
	<meta charset="UTF-8">
</head>

<body>
	<header>
		<img class="logo" src="https://static.wixstatic.com/media/01601d_fb07cbb4c1a44c51817e74c023bc5213~mv2.png/v1/fill/w_159,h_156,al_c,q_85,usm_0.66_1.00_0.01/Logotipo%201%20-%20PNG.webp" />
		<p>SITE ACERVO</p>
		<form action="busca.php">
			<input type="image" class="search" src="./images/Lupa.svg" />
			<input name="txbPesquisa" id="txbPesquisa" />
		</form>
		<nav class="usuario">
			<a href="<?php if ($bLogin) echo "usuario.php";
						else echo "login.htm" ?>">
				<image class="user" src="
				<?php if ($bLogin) echo "https://avatars.dicebear.com/api/gridy/" . $_SESSION["USRNOME"] . ".svg";
				else echo "./images/deslogado.svg"  ?>" />
			</a>
			<a href="<?php if ($bLogin) echo "usuario.php";
						else echo "login.htm" ?>" class="username">

				<?php if ($bLogin) echo $_SESSION["USRNOME"];
				else echo "Usuario" ?>
			</a>
		</nav>

	</header>
	<div class="boxMusic">
		<section><span>Os albuns mais novos</span></section>
		<article>
			<ul>
				<?php
				$sql = 'SELECT ALBCODIGO, ALBNOME FROM ALBUNS ORDER BY ALBCODIGO DESC LIMIT 0, 4';
				$consulta = mysqli_query($conexao, $sql);
				while ($vReg = mysqli_fetch_assoc($consulta)) {
					$nome = $vReg['ALBNOME'];
					echo "<li><img src='#' /> <a href='album.php?album=" . htmlspecialchars($nome) . "'>$nome</a></li>\n";
				}
				?>
			</ul>
		</article>
	</div>

	<div class="boxMusic">
		<section>
			<span>Albuns Aleatórios para você</span>
		</section>
		<article>
			<ul>
				<?php
				$num1 = random_int(1, $nMaxAlbuns);
				$num2 = random_int(1, $nMaxAlbuns);
				$num3 = random_int(1, $nMaxAlbuns);
				$num4 = random_int(1, $nMaxAlbuns);
				$sql = "SELECT ALBCODIGO, ALBNOME FROM ALBUNS WHERE ALBCODIGO = $num1 OR ALBCODIGO = $num2 OR ALBCODIGO = $num3 OR ALBCODIGO = $num4";
				$consulta = mysqli_query($conexao, $sql);
				while ($vReg = mysqli_fetch_assoc($consulta)) {
					$nome = $vReg['ALBNOME'];
					echo "<li><img src='#' /> <a href='album.php?album=" . htmlspecialchars($nome) . "'>$nome</a></li>\n";
				}
				?>
			</ul>
		</article>
	</div>

	<div class="boxMusic">
		<section><span>Albuns Aleatórios de
				<?php
				$bGeneroValido = false;
				while (!$bGeneroValido) {
					try {
						$sGenero = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT GNRCODIGO, GNRNOME FROM GENEROS WHERE GNRCODIGO LIKE " . random_int(1, $nMaxGeneros)));
						$nAlbuns = (int)mysqli_fetch_array(mysqli_query($conexao, "SELECT COUNT(ALBCODIGO) FROM ALBUNS WHERE ALBGENERO = " . $sGenero['GNRCODIGO']))[0];
						if ($nAlbuns >= 4)
							$bGeneroValido = true;
					} catch (\Throwable $th) {
						continue;
					}
				}

				echo $sGenero['GNRNOME'] ?>
			</span>
		</section>
		<article>
			<ul>
				<?php
				$sql = "SELECT ALBNOME FROM ALBUNS WHERE ALBGENERO = " . $sGenero["GNRCODIGO"] . " LIMIT 0,4";
				$consulta = mysqli_query($conexao, $sql);
				while ($vReg = mysqli_fetch_assoc($consulta)) {
					$nome = $vReg['ALBNOME'];
					echo "<li><img src='#' /> <a href='album.php?album=" . htmlspecialchars($nome) . "'>$nome</a></li>\n";
				}
				?>
			</ul>
		</article>
	</div>
	<a href="deslogar.php">Deslogar</a>
</body>

</html>