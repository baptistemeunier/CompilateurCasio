<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Code.php";
//require "Class/Run.php"; Class deprecated depuis la version 0.3.0--alpha
require "Class/Export.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Affichage du programme</title>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/pixelart.css">
	</head>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
	</script>
	<body>
	<?php 
	$data = array();
	for ($i=1; $i <= 63; $i++) { 
		for ($j=1; $j <= 127; $j++) { 
			if(rand(0, 255) < 128)
				$data[$i][$j] = true;
			else
				$data[$i][$j] = false;	
			//$data[$i][$j] = true;
		}
	}
 	$code = "";
 	foreach ($data as $ligne) {
		foreach ($ligne as $colonne) {
			if($colonne===true)
				$code.="1";
			else
				$code.="0";
		}
	}
	$export['save_db'] = false;
	$export['save_txt'] = false;
	$export['table'] = "pixelart";
	$export['titre'] = isset($_POST['title'])?$_POST['title']:md5(sha1(rand()));
	$save = new Export($code, null, $export); // Sauvegarde (bdd et txt)
	debug($save);
	?>
	<table border="1"  cellspacing="0" cellpadding="0">		
	<?php foreach ($data as $ligne) {
			echo"<tr>";
			foreach ($ligne as $colonne) {
				if($colonne===true)
					echo"<td class=\"active\"> </td>";
				else
					echo"<td> </td>";
			}
			echo"</tr>";
		}
	?>
	</table>
	</body>
</script>