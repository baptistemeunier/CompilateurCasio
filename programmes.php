<?php
session_start();
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
		<div id="a">Mes programmes</div>
		<div id="b">Tous vos programmes sont sauvegardés ici.<br/>Vous pouvez les modifier, changer le nom ou même le supprimer.</div>
		<?php
			$sql = Config::sql_connect();
			$requete = $sql->prepare("SELECT time FROM programmes WHERE user_id=:id ORDER BY time DESC");
			$requete->execute(array(
				'id' => $_SESSION['id']
			));
		?>
		<table>			
			<?php
			$programmes = $requete->fetchAll(PDO::FETCH_ASSOC);
			foreach ($programmes as $v) {
				?>
				<tr>
					<td><input type="text" name="title" id="title" placeholder="Nom du programme ?"></td>
					<td>Crée le : <?= date("d/m/Y H:i", $v['time']);?></td>
					<td>Modifier</td>
					<td>Supprimer</td>
				</tr>
				<?php
			} ?>
		</table>
	</body>
</html>