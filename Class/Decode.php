<?php
/**
 * Classe Decode
 *
 * Permet d'analyser le code fourni par l'utilisateur
 * @param String $data Text brut des instructions entrées par l'utilisateur
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 1.0
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées
	public $erreur = array();   // Liste des erreurs
	private $fonction_match  = array("~^CALCUL (.+)$~" => "calcul",
							   		 "~^LIRE (.+)$~" => "lire",
							   		 "~^AFFICHER (.+)$~" => "afficher",
							   		 "~^SET (.+)$~" => "set"
							   );   // Liste des fonction
	private $fonction_simple = array("STOP", "CLRTXT"); // Liste des instructions

	function __construct($data){
		$inctructions = explode("#", $data);      // On recupere les instuctions une par une (Qui sont sepater par un diese)
		foreach ($inctructions as $instruction) { // Pour chaque instruction
			foreach ($this->fonction_simple as $fonction) { // Si c'est une instruction simple
				if($instruction == $fonction){
					$add = $this->instruction($fonction); // Ajouts de l'instructions
					break;
				}
			}
			foreach ($this->fonction_match as $match => $fonction) { // Si c'est une fonction complexe
				if(preg_match($match, $instruction, $find)){
					$add = $this->$fonction($find[1]); // Ajouts de l'instructions
					break;
				}
			}
			if(substr($instruction, 0, 2)=="IF"){
				$add = $this->condition($instruction);
			}
			if(substr($instruction, 0, 5)=="WHILE"){
				$add = $this->bouclewhile($instruction);
			}
			$this->decode[] = $add;
		}
	}
	/**
	 * Function varAdd
	 *
	 * Ajoute la variable au tableau des variables (si besoin)
	 * @param La variable à ajouter (String [A-Z])
	 * @return boolean variable ajoutée ou non
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
	 * Function instruction
	 *
	 * Ajoute l'instruction simple à la liste des insctructions
	 * @param String $fonction La fonction à ajouté et les parametres
	 * @return void
	 **/
	private function instruction($fonction){
			$this->decode[] = array('fonction' => 'instruction',
									'params' => ucfirst(strtolower($fonction)));
	}
	private function condition($params){
		$params = explode("~", $params);
		$params[0] = explode(" ", $params[0]);
		$condition = $params[0][1];
		unset($params[0]);
		foreach ($params as $k => $instruc) { // Pour chaque instruction
			unset($params[$k]);
			if($instruc == "ELSE"){
				break 1;
			}
			foreach ($this->fonction_simple as $fonction) { // Si c'est une instruction simple
				if($instruc == $fonction){
					$if[] = $this->instruc($fonction); // Ajouts de l'instructions
					break;
				}
			}
			foreach ($this->fonction_match as $match => $fonction) { // Si c'est une fonction complexe
				if(preg_match($match, $instruc, $find)){
					$if[] = $this->$fonction($find[1]); // Ajouts de l'instructions
					break;
				}
			}
			if(substr($instruc, 0, 2)=="IF"){
				//$this->condition($instruc);
			}
		}
		foreach ($params as $instruc) { // Pour chaque instruction
			if($instruc == "ELSE"){
				break 1;
			}
			foreach ($this->fonction_simple as $fonction) { // Si c'est une instruction simple
				if($instruc == $fonction){
					$else[] = $this->instruc($fonction); // Ajouts de l'instructions
					break;
				}
			}
			foreach ($this->fonction_match as $match => $fonction) { // Si c'est une fonction complexe
				if(preg_match($match, $instruc, $find)){
					$else[] = $this->$fonction($find[1]); // Ajouts de l'instructions
					break;
				}
			}
			if(substr($instruc, 0, 2)=="IF"){
				//$this->condition($instruc);
			}
		}
			return array('fonction' => 'ifelse',
						 'params' => array('if' =>	array('condition' => $condition,
														'instruction' => $if),
						 					'else' => $else));
	}
	private function bouclewhile($params){
		$params = explode("&", $params);
		$params[0] = explode(" ", $params[0]);
		$condition = $params[0][1];
		unset($params[0]);
		foreach ($params as $k => $instruc) { // Pour chaque instruction
			unset($params[$k]);
			if($instruc == "ELSE"){
				break 1;
			}
			foreach ($this->fonction_simple as $fonction) { // Si c'est une instruction simple
				if($instruc == $fonction){
					$while[] = $this->instruc($fonction); // Ajouts de l'instructions
					break;
				}
			}
			foreach ($this->fonction_match as $match => $fonction) { // Si c'est une fonction complexe
				if(preg_match($match, $instruc, $find)){
					$while[] = $this->$fonction($find[1]); // Ajouts de l'instructions
					break;
				}
			}
			if(substr($instruc, 0, 2)=="IF"){
				//$this->condition($instruc);
			}
		}
		return array('fonction' => 'bouclewhile',
					 'params' => array('condition' => $condition,
					 'instruction' => $while));
	}

	/**
	 * Function afficher
	 *
	 * Ajoute l'instruction afficher à la liste des insctructions
	 * @param String $text Le contenu à afficher 
	 * @return void
	 **/
	private function afficher($text){
			if(preg_match("/^[A-Z]$/", $text)){
				$params = array('var' => $text);
			}else{
				$params = array('text' => $text);				
			}
			return array('fonction' => 'afficher',
					'params' => $params);
	}
	/**
	 * Function lire
	 *
	 * Ajoute l'instruction lire à la liste des insctructions
	 * @param Char/String $var La variable à lire 
	 * @return void
	 **/
	private function lire($var){
			return array('fonction' => 'lire',
									'params' => array('var' => $var));
	}
	/**
	 * Function calcul
	 *
	 * Ajoute l'instruction calcul à la liste des insctructions
	 * @param String $params Le calcul à afficher 
	 * @return void
	 **/
	private function calcul($params){
			$params = explode("=", $params);
			return array('fonction' => 'calcul',
									'params' => array('var' => $params[0], 'calcul' => $params[1]));
	}
	/**
	 * Function set
	 *
	 * Ajoute le parametre à la liste des insctructions
	 * @param String $text Le parametre à modifier
	 * @return void
	 **/
	private function set($set){
		$set = ucfirst(strtolower($set));
		$liste_set = array('Deg', 'Rad', 'Gra');
		if(in_array($set, $liste_set)){
			return array('fonction' => 'set',
									'params' => array('set' => $set));
		}else{
			$this->erreur[] = 'WARNING#Parametre '.$set.' inconnu';
		}	
	}
}

?>