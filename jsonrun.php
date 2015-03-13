<?php
/* Appel des differantes classe */
$data = "AFFICHER Resolution d'equation dans R#AFFICHER Ax^2+Bx+c#AFFICHER Saisir A#LIRE A#AFFICHER A#AFFICHER Saisir B#LIRE B#AFFICHER Saisir C#LIRE C#CALCUL D=B^2-4*A*C#CLRTXT#STOP#AFFICHER Delta =#AFFICHER D";
require "Class/Config.php";
require "Class/Decode.php";
$codepropre = new Decode($data); // Decode le code recu par le formulaire
?>
<script type="text/javascript">
	var instruction = 0;
	var input = "";
	<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
</script>
