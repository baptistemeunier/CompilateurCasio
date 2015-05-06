<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Text.php";
require "Class/Export.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Affichage du programme</title>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400' rel='stylesheet' type='text/css'>
	</head>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		
	</script>
	<body>
		<?php 
			$data = "Ce texte est un super long text pour teser si l'on peu rentrer ses cours sur le site #TextInutile";
			$Text = new Text($data);
			debug($Text->code);
			echo $Text->text;
			$export['save_db'] = false;
			$export['save_txt'] = false;
			$export['table'] = "text";
			$export['titre'] = isset($_POST['title'])?$_POST['title']:md5(sha1(rand()));
			$save = new Export($Text->code, $Text->code, $export); // Sauvegarde (bdd et txt)

		?>
	</body>
</html>