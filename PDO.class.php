<?php 

define('DBNAME', 'test');
define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');

class MYSQL {
	
	private static $isEnabled = false;
	public static function Connexion(){
		new self();
		
		if(!self::$isEnabled){
			$base = new PDO ('mysql:host='.HOST .';dbname='.DBNAME , USER, PASSWORD);
			return $base;
		}else{
			die();
		}
	}
	
	/* 
		
		$req = MYSQL::query(REQUETE SELECT);
		$result = MYSQL::fetchObject($req);
		
	*/
	
	// SELECT 
	public static function query($sql){
		$connexion = self::Connexion();
		$req = $connexion->query($sql);
		if($req === false) {
			$error = $connexion->errorInfo();
			self::error('Dans la requête : <br />'.$sql, $error[2]);
		}
		
		return $req;
	}
	
	public static function fetchObject($query) { 
		return $query->fetch(PDO::FETCH_OBJ);
	}
	
	public static function fetchAssoc($query) {
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	public static function numRows($query) {
		return $query->fetch(PDO::FETCH_NUM);
	}
	
	public static function isRows($query) {
		return (self::numRows($query) != 0);
	}
	
	// PARTIE ACTION BASE
	
	// DELETE / UPDATE / INSERT ETC
	public static function execute($sql) {
		$connexion = self::Connexion();
		$req = $connexion->exec($sql);
		
		if($req === false) {
			$error = $connexion->errorInfo();
			self::error('Dans la requête : <br />'.$sql, $error[2]);
		}
		
		return $req;
	}
	
	
	private static function error($txt, $erreur) {
		trigger_error('Erreur MySQL : '.$txt.'<br />Nom erreur : '.$erreur.'<br />', E_USER_ERROR);
	}
}