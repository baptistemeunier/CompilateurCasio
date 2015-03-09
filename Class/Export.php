<?php
/**
* Classe Export
*
* Permet de sauvagarder et d'exporter le code de l'utilisateur
* @param ...
**/
 
Class Export{

	function __construct($code_recu, $code_casio){
		$time = time(); 
		//$this->savedb($code_recu, $time);
		$this->savetxt($code_casio, $time);
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
			'time' => $time,
			'programme' => $code
		));
	}
	function savetxt($code, $time){
		// 1 : on ouvre le fichier
		$fichier = fopen($time.'.txt', 'a+');
		fwrite($fichier, $code);
		debug($fichier);
		// 2 : on fera ici nos opérations sur le fichier...

		// 3 : quand on a fini de l'utiliser, on ferme le fichier
		fclose($fichier);
	}
}
?>