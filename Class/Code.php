<?php
/**
 * Classe Code
 *
 * Permet d'ecrire le code decodé en langage Casio
 *
 * @param Array $data Tableau des insctructions
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.6.0--alpha
 **/

class Code{
	public $code; // Le programme en Casio
	private $si = 0;

	function __construct($data){
		$this->code = "0->A~Z\n";                                    // Initialisations des variables 
		foreach ($data as $inctruction){                             // Pour chaque instruction
			if($this->si!=0 && $inctruction['fonction']!="ifelse")
				$this->code .= "IfEnd\n";
			$this->$inctruction['fonction']($inctruction['params']); // Lancer la fonction qui traduit
		}
	}
	/**
	 * Function instruction
	 *
	 * Traduire une instruction simple en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function instruction($params){
		$this->code .= $params."\n";
	}
	/**
	 * Function afficher
	 *
	 * Traduire une instruction afficher en casio
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
	 * Traduire une instruction lire en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function lire($params){
		$var = $params['var'];
		$this->code .= "?->$var\n";
	}
	/**
	 * Function saut
	 *
	 * Traduire une instruction de saut en casio
	 * @param Array $params valeur et type de saut
	 * @return void
	 **/
	function saut($params){
		if(isset($params['goto']))
			$this->code .= "Goto ".$params['goto']."\n";
		else
			$this->code .= "Lbl ".$params['label']."\n";
	}
	/**
	 * Function menu
	 *
	 * Traduire une instruction menu en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function menu($params){
		$this->code .= 'Menu "'.$params['titre'].'"';
		foreach ($params['menu'] as $value)
			$this->code .= ','.$value['go'].',"'.$value['nom'].'"';
		$this->code .= "\n";
	}
	/**
	 * Function calcul
	 *
	 * Traduire une instruction calcul en casio
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
	/**
	 * Function ifelse
	 *
	 * Traduire un Array ifelse en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function ifelse($params){
		debug($params);
		if(isset($params['si'])){
			$this->code .= "If ";
			foreach ($params['conditions'] as $value) {
				$this->code .= $value." ";
			}
			$this->code .= "\nThen ";
			foreach ($params['si'] as $inctruction) {
					$this->$inctruction['fonction']($inctruction['params']);
			}
			$this->si = 1;
		}else{
			$this->code .= "Else ";
			foreach ($params['sinon'] as $inctruction) {
					$this->$inctruction['fonction']($inctruction['params']);
			}
			$this->code .= "IfEnd\n";
			$this->si = 0;
		}
	}
	/**
	 * Function bouclefor
	 *
	 * Traduire un Array while en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function bouclefor($params){
		$pour = explode("=", $params['conditions']['pour']);
		$this->code .= "For ".$pour[1]."->".$pour[0]." To ".$params['conditions']['a']." Step ".$params['conditions']['step']."\n";
		foreach ($params['instructions'] as $instruction)
			$this->$instruction['fonction']($instruction['params']);
		$this->code .= "Next\n";
	}
	/**
	 * Function boucledo
	 *
	 * Traduire un Array Do/while en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function boucledo($params){
		$this->code .= "Do ";
		foreach ($params['conditions'] as $value)
			$this->code .= $value." ";
		$this->code .= "LpWhile ";
		foreach ($params['instructions'] as $instruction)
			$this->$instruction['fonction']($instruction['params']);
		$this->code .= "\n";
	}
	/**
	 * Function bouclewhile
	 *
	 * Traduire un Array while en casio
	 * @param Array $params parametre de la fonction
	 * @return void
	 **/
	function bouclewhile($params){
		$this->code .= "While ";
		foreach ($params['conditions'] as $value)
			$this->code .= $value." ";
		$this->code .= "\n";
		foreach ($params['instructions'] as $instruction)
			$this->$instruction['fonction']($instruction['params']);
		$this->code .= "WhileEnd\n";
	}
}

?>