<?php
/**
 * Classe Run
 *
 * Permet d'executer le code envoyer
 * @param Array $data Tableau des insctructions| Array $var liste des variables
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.3.0--alpha
 * @deprecated 0.3.0--alpha Code passé en JavaScript
 **/
class Run{

	public $js = "";

	function __construct($data, $vars){                                 // On initialise
		$this->js = "$(init);
		/* Fonction d'initialisation */
		function init(){";
		foreach ($data as $inctruction){                             // Pour chaque instruction
			if($inctruction['fonction']==="afficher"){  // Juste pour les test
				$this->$inctruction['fonction']($inctruction['params']); // Lancer la fonction qui traduit
			}
		}
		$this->js .= "}";
	}

	function afficher($params){
		$text = $params['text'];
		if(strlen($text)==1){
		//	echo $this->vars[$text]." <br />";
		}else{
			$this->js .= "$(\"#console p\").append(\"$text<br />\");";
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
?>