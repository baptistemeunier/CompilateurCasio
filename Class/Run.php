/**
 * Classe Run
 *
 * Permet d'executer le code envoyer
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
