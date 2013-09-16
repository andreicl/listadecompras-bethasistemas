<!DOCTYPE html>
<html lang="en">
<head>
	<title>Fly - Lista de Compras</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/functions.js"></script>
</head>
<body>
	<header class="jumbotron subhead">
		<div class="row-fluid">
			<div class="span9">
				<img src="img/logo.png" />
			</div>
			<div class="span3">
				<?php
					if (isset($_SESSION['idUsuario'])) {
						echo '<a href="?login=send" class="pull-right" style="color:#FFF;padding:10px;">Sair</a>';
					}
				?>
			</div>
		</div>
	</header>