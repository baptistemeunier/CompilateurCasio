<?php
/* Appel des differantes classe */
$data = "AFFICHER Test calcul C=A+B#AFFICHER Saisir A#LIRE A#AFFICHER Saisir B#LIRE B#CALCUL C=B+A#AFFICHER C =#AFFICHER C";
require "Class/Config.php";
require "Class/Decode.php";
$codepropre = new Decode($data); // Decode le code recu par le formulaire
?>
<script type="text/javascript">
	<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
</script>
