<!DOCTYPE html>
<html lang="FR" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<title>Casio</title>
	</head>
	<body id="body">
		<section>
			<?php require('nav.php'); ?>
			<form method="post" action="traitement.php" id="programme">
				<h1>Programme</h1>
				<input type="text" name="title" id="title" placeholder="Entrer le nom du programme ?">
				<label for="save_db">Sauvegarder le programme sur votre profil : </label>
				<input type="checkbox" name="save_db">
				<label for="save_txt">Exporter le programme format txt</label>
				<input type="checkbox" name="save_txt">
				<label for="save_public">Rendre le programme public</label>
				<input type="checkbox" name="save_public">
				<button class="plus">+</button>
				<input type="text" id="data" name="data" placeholder="variable test d'envoie">
				<button id="submit">Validez</button>
			</form>
		</section>
	</body>
</html>