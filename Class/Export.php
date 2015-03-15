<?php
/**
* Classe Export
*
* Permet de sauvagarder et d'exporter le code de l'utilisateur
 * @param String $code_recu Code brut |String $code_recu Code casio 
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.3.0--alpha
 * @deprecated 0.3.0--alpha Code passé en JavaScript
 **/
 
Class Export{

	public $saved_db = false;
	public $saved_txt = false;

	function __construct($code_recu, $code_casio){
		$time = time(); 
		$this->savedb($code_recu, $time);
		$this->savetxt($code_casio, $time);
	}
	/**
	 * Function savedb
	 *
	 * Sauvegarde le code en BDD
	 * @param String $code Code brut | int $time le time() du moment où le classe a été appelée
	 * @return void
	 **/
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
	/**
	 * Function savetxt
	 *
	 * Sauvegarde le code en txt
	 * @param String $code Code casio | int $time le time() du moment où le classe a été appelée
	 * @return void
	 **/
	function savetxt($code, $time){
		$fichier = fopen("save_code/".$time.'.txt', 'a+');
		fwrite($fichier, $code);
		fclose($fichier);
		$this->saved_txt = $time;
	}
}
?>