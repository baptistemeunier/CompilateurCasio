<?php
/**
* Classe Export
*
* Permet de sauvagarder et d'exporter le code de l'utilisateur
* @param ...
**/
 
Class Export{

	function __construct($code_recu, $code_casio){
		//$this->savedb($code_recu);
		//$this->savetxt($code_recu);
	}

	function savedb($code){
		$dsn = 'mysql:dbname=isn;host=localhost';
		$user = 'root';
		$password = '';
		try {
		    $db = new PDO($dsn, $user, $password);
		}catch(PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}
		$req = $db->prepare("INSERT INTO programmes(user_id, time, programme) VALUES(:user_id, :time, :programme)");
		$req->execute(array(
			'user_id' => 1,
			'time' => time(),
			'programme' => $code
		));
	}
}
?>