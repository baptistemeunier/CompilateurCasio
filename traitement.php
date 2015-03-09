<?php
/* Appel des fonction de developement */ 
require "fonctionsdev.php"; 
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Code.php";
require "Class/Run.php";
require "Class/Export.php";
//SI D<0][AFFICHER Aucune solution][/]@
$data       = "AFFICHER Resolution d'equation dans R#AFFICHER Ax^2+Bx+c#AFFICHER Saisir A#LIRE A#AFFICHER Saisir B#LIRE B#AFFICHER Saisir C#LIRE C#CALCUL D=B^2-4*A*C#AFFICHER Delta =#AFFICHER D";
$codepropre = new Decode($data);                             // Decode le code recu par le formulaire
$code       = new Code($codepropre->decode);                       // Formate le code en langage Casio
debug($code->code);                                          // Affichage du code
//$run        = new Run($codepropre->decode, $codepropre->var_used);  // Test de programme envoyé
$save       = new Export($data , $code->code);  // Sauvegarde (bdd et txt)
