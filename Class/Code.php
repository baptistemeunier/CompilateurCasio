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
	/**
	 * Function instruction
	 *
	 * Traduire un instruction simple en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function instruction($params){
		$this->code .= $params."\n";
	}
	/**
	 * Function afficher
	 *
	 * Traduire un instruction afficher en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function afficher($params){
		if(isset($params['var'])==1){
			$this->code .= $params['var']."/\n";
		}else{
			$this->code .= "\"".$params['text']."\"\n";
		}
	}
	/**
	 * Function lire
	 *
	 * Traduire un instruction lire en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function lire($params){
		$var = $params['var'];
		$this->code .= "?->$var\n";
	}
	/**
	 * Function calcul
	 *
	 * Traduire un instruction calcul en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function calcul($params){
		$this->code .= $params['calcul'].'->'.$params['var']."\n";
	}
	/**
	 * Function afficher
	 *
	 * Traduire un paramettre à modifier en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function set($params){
		$this->code .= $params['set']."\n";
	}
}

?>