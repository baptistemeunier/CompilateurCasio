<?php 
require "fonctionsdev.php";
require "Class/Config.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/inscription.css">
		<title>Inscription</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<?php include("menu.php"); ?>
		<div><h1>Inscription<h1></div>

<?php
$erreur = true;
if(isset($_POST['pseudo'])){
	extract($_POST);
	if($pseudo != ""){
		if($pass != "" && $pass == $confirmation){
			$sql = Config::sql_connect();
			$requete = $sql->prepare("INSERT INTO users(pseudo, pass, inscription) VALUES(:pseudo, :pass, :inscription)");
			$requete->execute(array(
				'pseudo' => $pseudo,
				'pass' => $pass,
				'inscription' => time()
			));
			$erreur = false;
			echo"<h2>Vous étes maintenant inscrit</h2><p>Vous pouvez vous connecter</p>";
		}else{
			echo"<h2>Erreur!</h2><p>Merci d'entrer un mot de passe correct</p>";
		}
	}else{
		echo"<h2>Erreur!</h2><p>Merci d'entrer un pseudo</p>";

	}
}
if($erreur==true){
?>
		<form method="post" action="#">
			<p>Pseudo:</p>
			<input type="text" name="pseudo">
			<p>Mot de passe:</p>
			<input type="password" name="pass">
			<p>Confirmation mot de passe:</p>
			<input type="password" name="confirmation"><br/><br/>
			<input type="submit" value="Valider"/>
		</form>

<?php
}
?>
	</body>
</html>
<!-- but, demarche, collaboration -->