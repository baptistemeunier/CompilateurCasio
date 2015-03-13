<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Code.php";
require "Class/Run.php";
require "Class/Export.php";


$data = "AFFICHER Test calcul C=A*B#AFFICHER Saisir A#LIRE A#AFFICHER Saisir B#LIRE B#CALCUL C=A*B#AFFICHER C =#AFFICHER C";
$data = "AFFICHER C=A/B#AFFICHER Saisir A#LIRE A#AFFICHER Saisir B#LIRE B#CALCUL C=A/B#AFFICHER C =#AFFICHER C";
if(isset($_POST['data'])){ // Si une données est envoyée
	$data = $_POST['data'];
}
$codepropre = new Decode($data); // Decode le code recu par le formulaire
if(empty($codepropre->erreur)){  // Si aucune erreur
	$code = new Code($codepropre->decode);   // Formate le code en langage Casio
	debug($code->code);  // Affichage du code
	//$run        = new Run($codepropre->decode, $codepropre->var_used);  // Test de pro envoyé
	$save = new Export($data , $code->code); // Sauvegarde (bdd et txt)
}else{
	debug($codepropre->erreur); // Affichage des erreurs
}
?>