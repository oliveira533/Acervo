<?php 
	session_start();
	$bLogin = isset($_SESSION['USRCODIGO']);
?>

<html>
	<head>
		<link rel="stylesheet" href="inicio.css" />
		<meta charset="UTF-8">
	</head>
	<body>
		<header>
			<img
				class="logo"
				src="https://e7.pngegg.com/pngimages/223/71/png-clipart-ac-dc-logo-musical-ensemble-rock-band-rock-band-ac-dc-logo.png"
			/>
			<p>SITE ACERVO</p>
			<form action="search.php">
				<input
					type="image"
					class="search"
					src="./images/Lupa.svg"
				/>
				<input name="txbPesquisa" id="txbPesquisa" />
			</form>
			<a href="<?php if($bLogin)echo "usuario.php";
						else echo "login.htm" ?>">
				<image
					class="user"
					src="<?php if($bLogin)echo "./images/logado.svg";
						else echo "./images/deslogado.svg"  ?>"
			/></a>
			<a href="<?php if($bLogin)echo "usuario.php";
					else echo "login.htm" ?>" class="username">
					
					<?php if($bLogin)echo $_SESSION["USRNOME"];
					else echo "Usuario" ?>
					</a>
		</header>
		<div class="boxMusic">
			<section><span><?php echo($bLogin)? "Os seus albuns mais escutados": "Os albums mais escutados do momento" ?></span></section>
			<article>
				<ul>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
				</ul>
			</article>
		</div>

		<div class="boxMusic">
			<section>
				<span><?php echo($bLogin)? "Os seus albuns favoritos": "Albuns favoritos da galera"?></span>
			</section>
			<article>
				<ul>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
				</ul>
			</article>
		</div>

		<div class="boxMusic">
			<section><span><?php echo($bLogin)? "Os seus albuns menos escutados": "De uma chance a albuns novos!"?></span></section>
			<article>
				<ul>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
					<li><img src="#" /> <a href="album.htm">Salve</a></li>
				</ul>
			</article>
		</div>
	<a href="deslogar.php">Deslogar</a>
	</body>
</html>
