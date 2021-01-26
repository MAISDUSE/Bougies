<?php
namespace core;
//Classe Singleton permet la création d'une seule et unique instance de la classe
class Singleton
{
	private static $singleton = null;

	private function __construct(){}
  //Fonction redéfinie dans la classe qui extend celle-ci

	public static function getInstance(){
		if (self::$singleton == null)
			self::$singleton = new Singleton;
		return self::$singleton;
	}
}
