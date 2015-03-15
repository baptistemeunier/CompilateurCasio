<?php
/**
 * Classe Config
 *
 * Contient tout les parametres de configuration
 *
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.3.0--alpha
 **/

class Config{
	private static $sql = array('host' => 'localhost',
						 'dbname' => 'isn',
						 'user' => 'root',
						 'password' => ''); // Parametre SQL
	/**
	 * Function sql_connect
	 *
	 * Se connecte à la base de données 
	 * @return PDO Object $db
	 **/
	static function sql_connect(){
		try {
		     $db = new PDO('mysql:dbname='.self::$sql['dbname'].';host='.self::$sql['host'], self::$sql['user'], self::$sql['password']);
		}catch(PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $db;
	}
}