<?php
require "fonctionsdev.php";


$data = "[AFFICHER Entre A]-[LIRE A]-[AFFICHER Entre B]-[LIRE B]-[CALCUL C]A+B[/]-[AFFICHER C]";
$codepropre = new Decode($data);
debug($codepropre->decode);
//$code = new Decode($data);
//debug($codepropre->decode);

/**
 * Classe Decode
 *
 * Classe qui permet d'analyser le code fourni par l'utilisateur
 * @param Text brut des instructions entrées par l'utilisateur
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées

	function __construct($data){
		$inctructions = explode("-", $data);      // On recupere les instuctions une par une
		foreach ($inctructions as $inctruction) { // Pour chaque instruction
			
			if(preg_match("~^\[([A-Z]+) ([A-Za-z0-9 ]+)\]$~", $inctruction, $find)){             // Instruction simple style ([LIRE A])
				$this->varAdd($find[2]);                                                     // Ajouts à la liste des variables
				$this->inctruction($find[1], $find[2]);                                      // Ajouts de l'instructions
			}else if(preg_match("~^\[(.+) ([A-Z])\](.+)\[/\]$~", $inctruction, $find)){          // Instruction complexe style ([CALCUL C]A+B[/])
				$this->varAdd($find[2]);                                                     // Ajouts à la liste des variables
				$this->inctruction($find[1], array('var' => $find[2], 'param' => $find[3])); // Ajouts de l'instructions
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
		if(strlen($var)==1 && !in_array($var, $this->var_used)){
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
		$this->decode[] = array('fonction' => strtolower($fonction),
								'params' => $param);
	}
}
