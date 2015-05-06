<?php
session_start();
require "fonctionsdev.php";
require "Class/Config.php";
?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/inscription.css">
		<title>Connexion</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php include("menu.php"); ?>
			<div><h1>Connexion<h1></div>
<?php
if(isset($_POST['pseudo'])){
	extract($_POST);
	$sql = Config::sql_connect();
	$requete = $sql->prepare("SELECT * FROM users WHERE pseudo=:pseudo AND pass=:pass LIMIT 1");
	$requete->execute(array(
		'pseudo' => $pseudo,
		'pass' => $pass
	));
	$compte = $requete->fetch();
	if($compte != null){
		echo'<h2>Connexion reussie</h2>';
		echo'<p>Bienvenue '.$pseudo.', Bon code ! </p>';
		$_SESSION = array('id' => $compte['id'], 'pseudo' => $pseudo);
	}else{ ?>
		<h2>Pseudo ou mot de passe incorect</h2>
		<form method="post" action="#">
		<p>Pseudo:</p>
		<input type="text" name="pseudo">
		<p>Mot de passe:</p>
		<input type="password" name="pass"><br/><br/>
		<input type="submit" value="Valider"/>
		</form>
	<?php
	}
}else{
?>		
		<form method="post" action="#">
			<p>Pseudo:</p>
			<input type="text" name="pseudo">
			<p>Mot de passe:</p>
			<input type="password" name="pass"><br/><br/>
			<input type="submit" value="Valider"/>
		</form>
<?php
}
?>
	</body>
</html>