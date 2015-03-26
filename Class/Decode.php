<?php
/**
 * Classe Decode
 *
 * Permet d'analyser le code fourni par l'utilisateur
 * @param String $data Text brut des instructions entrées par l'utilisateur
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.6.0--alpha
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées
	public $erreur = array();   // Liste des erreurs
	private $fonction_match  = array("~^CALCUL (.+)$~" => "calcul",
							   		 "~^LIRE (.+)$~" => "lire",
							   		 "~^AFFICHER (.+)$~" => "afficher",
							   		 "~^SET (.+)$~" => "set",
							   		 "~^GOTO (.+)$~" => "sautgoto",
							   		 "~^LABEL (.+)$~" => "sautlabel",
							   		 "~^MENU (.+)$~" => "menu",
							   );   // Liste des fonction
	private $fonction_simple = array("STOP", "CLRTXT"); // Liste des instructions

	function __construct($data){
		$inctructions = explode("#", $data);      // On recupere les instuctions une par une (Qui sont sepater par un diese)
		$this->decode = $this->ajout($inctructions);
	}
	/**
	 * Function ajout
	 *
	 * Retourne la liste d'insctuction formaté
	 * @param Array $inctructions Le tableau brut des insctructions
	 * @return Array $decode liste d'insctuction formaté
	 **/
	private function ajout($inctructions){
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
			if(substr($instruction, 0, 2)=="SI"){
				$si = (substr($instruction, 0, 5)=="SINON")?false:true;
				$add = $this->ifelse($instruction, $si);
			}
			if(substr($instruction, 0, 5)=="WHILE")
				$add = $this->bouclewhile(substr($instruction, 6));
			if(substr($instruction, 0, 3)=="FOR")
				$add = $this->bouclefor(substr($instruction, 4));
			if(substr($instruction, 0, 7)=="DOWHILE")
				$add = $this->bouclefor(substr($instruction, 8));
			$decode[] = $add;
		}
		return $decode;
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
			return array('fonction' => 'instruction',
									'params' => ucfirst(strtolower($fonction)));
	}
	/**
	 * Function sautgoto
	 *
	 * Ajoute l'instruction Goto à la liste des insctructions
	 * @param string $saut le type de saut
	 * @return Array Tableau des parametre du saut
	 **/
	private function sautgoto($saut){
			return array('fonction' => 'saut',
						'params' => array("goto" => $saut));
	}
	/**
	 * Function menu
	 *
	 * Ajoute l'instruction menu à la liste des insctructions
	 * @param string $params les parametre du menu
	 * @return Array Tableau des parametres du menu
	 **/
	private function menu($params){
			$params = explode("~", $params);
			$titre = $params[0];
			$menu = array();
			unset($params[0]);
			for($i=1; $i < count($params); $i=$i+2){
				$menu[] = array('go' => $params[$i], 'nom' => $params[$i+1]);
			}
			return array('fonction' => 'menu',
						'params' => array("titre" => $titre, 'menu' => $menu));
	}
	/**
	 * Function sautlabel
	 *
	 * Ajoute l'instruction Label à la liste des insctructions
	 * @param id $saut le type de saut
	 * @return Array Tableau des parametre du saut
	 **/
	private function sautlabel($saut){
			return array('fonction' => 'saut',
						'params' => array("label" =>  $saut));
	}
	/**
	 * Function ifelse
	 *
	 * Ajoute l'instruction if/else à la liste des insctructions
	 * @param String $params les texte brut Boolean $si true si on est dans un if sinon false
	 * @return Array $add Tableau des parametre du if
	 **/
	private function ifelse($params, $si){
		$params = ($si==true)?substr($params, 3):substr($params, 6);
		$params = explode("~", $params);
		$add = array('fonction' => 'ifelse');
		if($si == true){
			$conditions = explode(":", $params[0]);
			unset($params[0]);
			$add['params']['conditions'] = $conditions;
			$add['params']['si'] = $this->ajout($params);
		}else{
			$add['params']['sinon'] = $this->ajout($params);
		}
		return $add;
	}
	/**
	 * Function bouclewhile
	 *
	 * Ajoute l'instruction while à la liste des insctructions
	 * @param String $params les texte brut
	 * @return Array $add Tableau des parametre du while
	 **/
	private function bouclewhile($params){
		$params = explode("&", $params);
		$conditions = explode(":", $params[0]);
		unset($params[0]);
		$add = array('fonction' => 'bouclewhile', 'params' => array('conditions' => $conditions, 'instructions' => $this->ajout($params)));
		return $add;
	}
	/**
	 * Function bouclefor
	 *
	 * Ajoute l'instruction for à la liste des insctructions
	 * @param String $params les texte brut
	 * @return Array $add Tableau des parametre du while
	 **/
	private function bouclefor($params){
		$params = explode("%", $params);
		$conditions = explode(":", $params[0]);
		unset($params[0]);
		$add = array('fonction' => 'bouclefor', 'params' => array('pour' => $conditions[0],
		'a' => $conditions[1], 'step' => $conditions[2], 'instructions' => $this->ajout($params)));
		return $add;
	}
	/**
	 * Function boucledo
	 *
	 * Ajoute l'instruction do à la liste des insctructions
	 * @param String $params les texte brut
	 * @return Array $add Tableau des parametre du while
	 **/
	private function boucledo($params){
		$params = explode("$", $params);
		$conditions = explode(":", $params[0]);
		unset($params[0]);
		$add = array('fonction' => 'boucledo', 'params' => array('conditions' => $conditions, 'instructions' => $this->ajout($params)));
		return $add;
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