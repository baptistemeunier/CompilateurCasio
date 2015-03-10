<?php
/**
 * Classe Config
 *
 * Contient tout les parametres de configuration
 * 
 **/
class Config{
	private static $sql = array('host' => 'localhost',
						 'dbname' => 'isn',
						 'user' => 'root',
						 'password' => '');
	
	static function sql_connect(){
		try {
		     $db = new PDO('mysql:dbname='.self::$sql['dbname'].';host='.self::$sql['host'], self::$sql['user'], self::$sql['password']);
		}catch(PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $db;
	}
}