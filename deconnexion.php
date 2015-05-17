<?php
session_start();
session_destroy();
require "fonctionsdev.php";
require "Class/Config.php";
?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/programmes.css">
		<title>Mes programmes</title>
		<meta charset="UTF-8">
	</head>

	<body>
		<?php include("menu.php"); ?>
		<h2>Vous êtes maintenant deconnecter</h2>
	</body>
</html>