<?php
session_start();

if(!isset($_SESSION['USRCODIGO']))
	header('location: login.htm');
?>
<html>

<body>
Voce tem acesso a esta pagina.
</body>

</html>