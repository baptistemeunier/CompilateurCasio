<?php
/**
 * Classe Decode
 *
 * Permet d'analyser le code fourni par l'utilisateur
 * @param Text brut des instructions entrées par l'utilisateur
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées
	public $erreur = array();   // Liste des erreurs

	function __construct($data){
		$inctructions = explode("#", $data);      // On recupere les instuctions une par une (Qui sont sepater par un diese)
		foreach ($inctructions as $inctruction) { // Pour chaque instruction
			
			if(preg_match("~^CALCUL ([A-Z])=(.+)$~", $inctruction, $find)){ 
				$this->varAdd($find[1]);                                                                  // Ajouts à la liste des variables
				$this->inctruction("calcul", array('var' => trim($find[1]), 'calcul' => trim($find[2]))); // Ajouts de l'instructions
			}else if(preg_match("~^([A-Za-z]+) (.+)$~", $inctruction, $find)){ 
				$this->varAdd($find[2]);                             // Ajouts à la liste des variables
				$this->inctruction(trim($find[1]), trim($find[2]));  // Ajouts de l'instructions
			}else{
				debug($inctruction);
			}
		}
	}
	/**
	 * Function varAdd
	 *
	 * Ajoute la variable au tableau des variables (si besoin)
	 * @param La variable à ajouter (String [A-Z])
	 * @return Boolean variable ajoutée ou non
	 **/
	private function varAdd($var){
		$var = trim($var);
		if(strlen($var)==1 && !in_array($var, $this->var_used)){ // Si la variable n'est pas dejà dans le tableau
			$this->var_used[] = $var;
			return true;
		}
		return false;
	}
	/**
	 * Function inctruction
	 *
	 * Ajoute l'inctruction à la liste des insctructions
	 * @param La fonction à ajouté et les parametres
	 **/
	private function inctruction($fonction, $param){
		$fonction = strtolower($fonction);
		if(in_array($fonction, Config::$fonctions_supportees)){
			$this->decode[] = array('fonction' => $fonction,
									'params' => $param);	
		}else{
			$this->erreur[] = 'ERROR#Fonction '.$fonction.' inconnu';
		}
	}
}

?>