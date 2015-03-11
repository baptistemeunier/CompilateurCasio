<?php
/**
 * Classe Code
 *
 * Permet d'ecrire le code decodé en langage Casio
 * @param Tableau des insctructions
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
		$text = $params['text'];
		if(strlen($text)==1){
			$this->code .= $text."/\n";
		}else{
			$this->code .= "\"$text\"\n";
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