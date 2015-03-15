<?php
/**
* Classe Export
*
* Permet de sauvagarder et d'exporter le code de l'utilisateur
* @param ...
**/
 
Class Export{

	public $saved_db = false;
	public $saved_txt = false;

	function __construct($code_recu, $code_casio){
		$time = time(); 
		$this->savedb($code_recu, $time);
		$this->savetxt($code_casio, $time);
	}

	function savedb($code, $time){
		$sql = Config::sql_connect();
		$requete = $sql->prepare("INSERT INTO programmes(user_id, time, programme) VALUES(:user_id, :time, :programme)");
		$requete->execute(array(
			'user_id' => 1,
			'time' => $time,
			'programme' => $code
		));
		$this->saved_db = true;
	}
	
	function savetxt($code, $time){
		$fichier = fopen("save_code/".$time.'.txt', 'a+');
		fwrite($fichier, $code);
		fclose($fichier);
		$this->saved_txt = $time;
	}
}
?>