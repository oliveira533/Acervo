<?php 
	session_start();
	$bLogin = isset($_SESSION['USRCODIGO']);
?>

<html>
	<head>
		<link rel="stylesheet" href="inicio.css" />
		<link rel="stylesheet" href="bootstrap.min.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<header>
			<img
				class="logo"
				src="https://static.wixstatic.com/media/01601d_fb07cbb4c1a44c51817e74c023bc5213~mv2.png/v1/fill/w_159,h_156,al_c,q_85,usm_0.66_1.00_0.01/Logotipo%201%20-%20PNG.webp"
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
