<?php
/* Appel des differantes classe */
require "Class/Config.php";
require "Class/Decode.php";
require "Class/Export.php";
$sql = Config::sql_connect();
$requete = $sql->prepare("SELECT programme FROM programmes WHERE id=:id");
$requete->execute(array('id' => $_GET['code']));
$data = $requete->fetch()['programme'];
$codepropre = new Decode($data); // Decode le code recu par le formulaire
?>
<script type="text/javascript">
	<?= "var liste_instruction = ".json_encode($codepropre->decode).";"; ?>
</script>
