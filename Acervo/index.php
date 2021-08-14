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
					src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Vector_search_icon.svg/1200px-Vector_search_icon.svg.png"
				/>
				<input name="txbPesquisa" id="txbPesquisa" />
			</form>
			<a href="login.htm">
				<image
					class="user"
					src="<?php if($bLogin)echo "./images/logado.svg";
						else echo "./images/deslogado.svg"  ?>"
			/></a>
			<a href="login.htm" class="username">Usuário</a>
		</header>
		<div class="boxMusic">
			<section><span>Os seus mais Escutados</span></section>
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
				<span>Seus <br />Favoritos</span>
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
			<section><span>Seus Menos Escutados</span></section>
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
