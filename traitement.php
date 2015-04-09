<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Code.php";
//require "Class/Run.php"; Class deprecated depuis la version 0.3.0--alpha
require "Class/Export.php";

//$data = "AFFICHER Saisir A#LIRE A#WHILE A==1&AFFICHER A&LIRE A&AFFICHER PGM#AFFICHER Sorti";
$data = "AFFICHER teTE#MENU Test~1~Valeur 1~2~Hello~6~Valeur 10#GOTO 0#LABEL 0#AFFICHER test#AFFICHER test#AFFICHER Saisi#AFFICHER Saisi#AFFICHER Saisi#AFFICHER Saisi#AFFICHER Saisi#AFFICHER Saisi#AFFICHER Saisie A#LIRE A#CALCUL C=A+100#AFFICHER C = A+100 = #AFFICHER test#AFFICHER test#AFFICHER test#AFFICHER A";
//$data = "AFFICHER Test si#SI A=0:AND B>1~AFFICHER dans le if~AFFICHER Toujours dans le if#SINON AFFICHER HOrs if~AFFICHER Toujours hors if#AFFICHER fin";
//$data = "AFFICHER Test si#SI A=0:AND B>1~AFFICHER dans le if~AFFICHER Toujours dans le if#AFFICHER fin";

if(isset($_POST['data'])){ // Si une données est envoyée
	$data = trim($_POST['data']);
}
$export['titre'] = isset($_POST['title'])?$_POST['title']:md5(sha1(rand()));
$export['save_db'] = isset($_POST['save_db'])?true:false;
$export['save_txt'] = isset($_POST['save_txt'])?true:false;


$codepropre = new Decode($data); // Decode le code recu par le formulaire
if(empty($codepropre->erreur)){  // Si aucune erreur
	$code = new Code($codepropre->decode);   // Formate le code en langage Casio
	$save = new Export($data, $code->code, $export); // Sauvegarde (bdd et txt)
}else{
	debug($codepropre->erreur); // Affichage des erreurs
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Affichage du programme</title>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/traitement.css">
	</head>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
	</script>

	<script type="text/javascript" src="js/run.js"></script>
	<body>
		<section id="console">
			<div class="console_test">
				<table class="affichage">
					<tr>
						<td class="ligne" id="a1">Une ligne normal FIN!</td>		
					</tr>
					<tr>
						<td class="ligne" id="a2">Une ligne normal FIN!</td>
					</tr>
					<tr>
						<td class="ligne" id="a3">Une ligne normal FIN!</td>		
					</tr>
					<tr>
						<td class="ligne" id="a4">Une ligne normal FIN!</td>		
					</tr>
					<tr>
						<td class="ligne" id="a5">Une ligne normal FIN!</td>		
					</tr>
					<tr>
						<td class="ligne" id="a6">Une ligne normal FIN!</td>		
					</tr>
					<tr>
						<td class="ligne" id="a7">Une ligne normal FIN!</td>		
					</tr>
				</table>
			</div>
			<div class="input_test">
			<table cellspacing="10" class="input">
				<tr>
					<td class="input" id="7"></td>
					<td class="input" id="8"></td>
					<td class="input" id="9"></td>
					<td class="input" id="DEL"></td>
					<td class="input" id="AC"></td>
				</tr>
				<tr>
					<td class="input" id="4"></td>
					<td class="input" id="5"></td>
					<td class="input" id="6"></td>
				</tr>
				<tr>
					<td class="input" id="1"></td>
					<td class="input" id="2"></td>
					<td class="input" id="3"></td>
				</tr>
				<tr>
					<td class="input" id="0"></td>
					<td class="input" id="POINT"></td>
					<th></th>
					<th></th>
					<td class="input" id="EXE"></td>
				</tr>
			</table>
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