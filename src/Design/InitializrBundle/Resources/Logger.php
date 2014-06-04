<?php

namespace Design\InitializrBundle\Resources;

/*
 * Utilisation : 
 * 	$loga = Logger::getInstance();
 * 	$loga->log("toutéok");
 */
class Logger
{
	/**
	 * @var Singleton
	 * @access private
	 * @static
	 */
	private static $_instance = null;
	
	private $_file;
	private $_fileName;
	private $_path;
	
	
	public function log($message)
	{
		if($this->_file != null)
			return;
		
		// Change the line below to your timezone!
		date_default_timezone_set('Europe/Paris');
		$date = date('d/m/Y h:i:s a', time());
		
		$entete = "Date : " . $date . "\nMessage : ";
		$this->_file = fopen($this->_fileName, 'a+');
		
		fputs($this->_file, $entete . $message . "\n\n"); // On écrit le nouveau nombre de pages vues
		
		fclose($this->_file);
		$this->_file = null;
	}
	
	/**
	 * Constructeur de la classe
	 *
	 * @param void
	 * @return void
	 */
	private function __construct()
	{
		$this->_path = "./";
		$this->_fileName = "myLog.log";
	}
	
	/**
	 * Méthode qui crée l'unique instance de la classe
	 * si elle n'existe pas encore puis la retourne.
	 *
	 * @param void
	 * @return Singleton
	 */
	public static function getInstance()
	{
		if(is_null(self::$_instance))
		{
			self::$_instance = new Logger();
		}
		
		return self::$_instance;
	}
}

?>