<?php
/**
* Classe Export
*
* Permet de sauvagarder et d'exporter le code de l'utilisateur
 * @param String $code_recu Code brut |String $code_recu Code casio | Array $options les options de savaugarde
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.3.0--alpha
 **/
 
Class Export{

	public $saved_db = false;
	public $saved_txt = false;

	function __construct($code_recu, $code_casio, $options){
		if($options['save_db']==true)
			$this->savedb($code_recu, $options['titre']);
		if($options['save_txt']==true)
			$this->savetxt($code_casio, $options['titre']);
	}
	/**
	 * Function savedb
	 *
	 * Sauvegarde le code en BDD
	 * @param String $code Code brut | String $titre Titre du programme
	 * @return void
	 **/
	function savedb($code, $titre){
		$sql = Config::sql_connect();
		$requete = $sql->prepare("INSERT INTO programmes(user_id, time, programme) VALUES(:user_id, :time, :programme)");
		$requete->execute(array(
			'user_id' => 1,
			'time' => time(),
			'programme' => $code
		));
		$this->saved_db = true;
	}
	/**
	 * Function savetxt
	 *
	 * Sauvegarde le code en txt
	 * @param String $code Code casio | String $titre Titre du programme
	 * @return void
	 **/
	function savetxt($code, $titre){
		$fichier = fopen("save_code/".$titre.'.txt', 'a+');
		fwrite($fichier, $code);
		fclose($fichier);
		$this->saved_txt = $titre;
	}
}
?>