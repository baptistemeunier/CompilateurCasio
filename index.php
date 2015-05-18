<?php session_start(); ?>
<!DOCTYPE html>
<html lang="FR" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/menu.css" />
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script type="text/javascript" src="js/css.js"></script>
		<title>Casio</title>
	</head>
	<body id="body">
		<?php require('menu.php'); ?>
		<section>
			<?php require('nav.php'); ?>
			<form method="post" name="form" onsubmit="return validateForm()" id="formulaire" action="traitement.php">
				<input type="text" name="title" id="title" value="Nom du programme ?">
				<div id="programme">
					<button class="plus">+</button>
				</div>
				<div id="footer">
					<input type="hidden" id="data" name="data">
					<button id="submit">Validez</button>
					<label for="save_db">Sauvegarder le programme sur votre profil : </label>
					<input type="checkbox" name="save_db" class="checkbox">
					<label for="save_txt">Exporter le programme en format txt : </label>
					<input type="checkbox" name="save_txt" class="checkbox">
					<label for="save_public">Rendre le programme public : </label>
					<input type="checkbox" name="save_public" class="checkbox">
				</div>
			</form>
		</section>
	</body>
</html>