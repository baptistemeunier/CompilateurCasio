<?php
require "fonctionsdev.php";

$data = "[AFFICHER Entre A]@[LIRE A]@[AFFICHER Entre B]@[LIRE B]@[CALCUL C]A+B+5[/]@[AFFICHER C]"; // Code reçu par la formulaire
$data = "[CALCUL A]5[/]@[AFFICHER A =]@[AFFICHER A]";
$codepropre = new Decode($data);                             // Decode le code recu par le formulaire
$code = new Code($codepropre->decode);                       // Formate le code en langage Casio
debug($code->code);                                          // Affichage du code
$run = new Run($codepropre->decode, $codepropre->var_used);  // Test de programme envoyé

/**
 * Classe Decode
 *
 * Permet d'analyser le code fourni par l'utilisateur
 * @param Text brut des instructions entrées par l'utilisateur
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées

	function __construct($data){
		$inctructions = explode("@", $data);      // On recupere les instuctions une par une
		foreach ($inctructions as $inctruction) { // Pour chaque instruction
			
			if(preg_match("~^\[([A-Z]+) ([^\]]+)\]$~", $inctruction, $find)){         // Instruction simple style ([LIRE A])
				$this->varAdd($find[2]);                                                     // Ajouts à la liste des variables
				$this->inctruction($find[1], $find[2]);                                      // Ajouts de l'instructions
			}else if(preg_match("~^\[(.+) ([A-Z])\](.+)\[/\]$~", $inctruction, $find)){      // Instruction complexe style ([CALCUL C]A+B[/])
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
		$this->decode[] = array('fonction' => strtolower($fonction),
								'params' => $param);
	}
}
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

	function afficher($text){
		if(strlen($text)==1){
			$this->code .= $text."/|\n";
		}else{
			$this->code .= "$text\n";
		}
	}

	function lire($var){
		$this->code .= "?->$var\n";
	}
	
	function calcul($params){
		$this->code .= $params['var'].'->'.$params['param']."\n";
	}
}
/**
 * Classe Code
 *
 * Permet d'ecrire le code decodé en langage Casio
 * @param Tableau des insctructions
 * @param Tableau des variables
 **/
class Run{

	private $vars = array();

	function __construct($data, $vars){
		foreach ($vars as $var)                                      // Pour chaque instruction
			$this->vars[$var] = 0;                                   // On initialise
		foreach ($data as $inctruction){                             // Pour chaque instruction
			$this->$inctruction['fonction']($inctruction['params']); // Lancer la fonction qui traduit
		}
	}

	function afficher($text){
		if(strlen($text)==1){
			echo $this->vars[$text]." <br />";
		}else{
			echo "$text <br />";
		}
	}

	function lire($var){
		echo "?->$var <br />";
	}
	
	function calcul($params){
		for ($i=0; $i < strlen($params['param']); $i++) {
			$caractere = $params['param'][$i];
			if(preg_match("#[A-Z]#", $caractere)){
				$params['param'][$i] = $this->vars[$caractere];
			}
		}
		$this->vars[$params['var']] = $params['param'];
	}
}
