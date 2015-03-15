<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Code.php";
require "Class/Run.php";
require "Class/Export.php";

$data = "AFFICHER C=A/B#AFFICHER Saisir A#LIRE A#AFFICHER Saisir B#LIRE B#CALCUL C=A/B#AFFICHER C =#AFFICHER C";
if(isset($_POST['data'])){ // Si une données est envoyée
	$data = $_POST['data'];
}
$codepropre = new Decode($data); // Decode le code recu par le formulaire
if(empty($codepropre->erreur)){  // Si aucune erreur
	$code = new Code($codepropre->decode);   // Formate le code en langage Casio
	$save = new Export($data , $code->code); // Sauvegarde (bdd et txt)
}else{
	debug($codepropre->erreur); // Affichage des erreurs
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Affichage du programme</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/traitement.css">
	</head>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
	</script>

	<script type="text/javascript" src="js/run.js"></script>
	<body>
		<section id="console">
			<h2>Testez votre programme !</h2>
			<div class="console">
				<p id="text-console"></p>
			</div>
			<div class="input">
				<form>
					<input type="number" id="input">
					<button id="send">Send</button>
				</form>
				<button id="next">Next</button>
			</div>
		</section>
		<section id="code">
			<h2>Votre programme au format CASIO</h2>
			<?= "<pre>".$code->code."</pre>" // Affichage du code ?>
		</section>
		<!-- Section Saugegarde (BDD et Text )-->
		<section id="save">
			<h2>Sauvegarde de votre programme</h2>
			<?php 
			if($save->saved_db != false){
				echo'<p class="valid">-> Programme sauvegardé dans votre profil</p>';
			}else{ 
				echo'<p class="error">-> Programme non sauvegardé dans votre profil</p>';
			}
			if($save->saved_txt != false){
				echo'<p class="valid">-> Programme exporté au format .txt <a href="save_code/'.$save->saved_txt.'.txt" target="_blank">Télécharger</p>';
			} ?>
		</section>
	</body>
</html>