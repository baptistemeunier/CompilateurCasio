<?php
/* Appel des fonction de developement */ 
require "fonctionsdev.php"; 
/* Appel des differantes classe */
require "Class/Decode.php";
require "Class/Code.php";
require "Class/Run.php";

$data = "[AFFICHER Entre A]@[LIRE A]@[AFFICHER Entre B]@[LIRE B]@[CALCUL C]A+B+5[/]@[AFFICHER C]"; // Code reçu par la formulaire
$data = "[CALCUL A]5[/]@[AFFICHER A =]@[AFFICHER A]";
$codepropre = new Decode($data);                             // Decode le code recu par le formulaire
$code = new Code($codepropre->decode);                       // Formate le code en langage Casio
debug($code->code);                                          // Affichage du code
$run = new Run($codepropre->decode, $codepropre->var_used);  // Test de programme envoyé

