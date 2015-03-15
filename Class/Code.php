<?php
/**
 * Classe Code
 *
 * Permet d'ecrire le code decodé en langage Casio
 *
 * @param Array $data Tableau des insctructions
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.3.0--alpha
 **/

class Code{
	public $code; // Le programme en Casio

	function __construct($data){
		$this->code = "0->A~Z\n";                                    // Initialisations des variables 
		foreach ($data as $inctruction){                             // Pour chaque instruction
			$this->$inctruction['fonction']($inctruction['params']); // Lancer la fonction qui traduit
		}
	}

	function instruction($params){
		$this->code .= $params."\n";
	}
	
	function afficher($params){
		if(isset($params['var'])==1){
			$this->code .= $params['var']."/\n";
		}else{
			$this->code .= "\"".$params['text']."\"\n";
		}
	}

	function lire($params){
		$var = $params['var'];
		$this->code .= "?->$var\n";
	}
	
	function calcul($params){
		$this->code .= $params['calcul'].'->'.$params['var']."\n";
	}
	
	function set($params){
		$this->code .= $params['set']."\n";
	}
}

?>