<?php
require "fonctionsdev.php";


$data = "[AFFICHER Entre A]-[LIRE A]-[AFFICHER Entre B]-[LIRE B]-[CALCUL C]A+B[/]-[AFFICHER C]";
$codepropre = new Decode($data);
debug($codepropre->decode);
$code = new Decode($data);
debug($codepropre->decode);

/**
 * Classe Decode
 *
 * Classe qui permet d'analyser le code fourni par l'utilisateur
 * @param Text brut des instructions entrées par l'utilisateur
 *
 **/
class Decode{

	public $var_used = array(); // Liste des variables utilisées
	public $decode = array();   // Liste des instructions formatées

	function __construct($data){
		$inctructions = explode("-", $data); // On recupere les instuctions une par une
		foreach ($inctructions as $inctruction) { // Pour chaque instruction
			
			if(preg_match("~^\[([A-Z]+) ([A-Za-z0-9 ]+)\]$~", $inctruction, $find)){
				if(strlen($find[2])==1 && !in_array($find[2], $this->var_used)){
					$this->var_used[] = $find[2];
				}
				$this->inctruction($find[1], $find[2]);
			}else if(preg_match("~^\[(.+) ([A-Z])\](.+)\[/\]$~", $inctruction, $find)){
				if(!in_array($find[2], $this->var_used)){
					$this->var_used[] = $find[2];
				}
				$this->inctruction($find[1], array('var' => $find[2], 'param' => $find[3]));
			}else{
				debug($inctruction);
			}
		}
	}

	private function inctruction($fonction, $param){
		$this->decode[] = array('fonction' => strtolower($fonction),
								'params' => $param);
	}
}
