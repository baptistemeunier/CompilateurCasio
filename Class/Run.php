<?php
/**
 * Classe Run
 *
 * Permet d'executer le code envoyer
 * @param Tableau des insctructions
 * @param Tableau des variables
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