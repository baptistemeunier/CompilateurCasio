<!DOCTYPE html>
<html lang="FR" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<title>Casio</title>
	</head>
	<body id="body">
		<?php
			require('nav.php');
		?>
		<section>
			<h1>Programme</h1>
			<form method="post" action="#" id="programme">
				<button class="plus">+</button>
			</form>
			<form method="post" action="traitement.php" id="form">
				<input type="text" id="data" name="data">
				<button id="submit">Validez</button>
			</form>
		</section>
	</body>
</html>