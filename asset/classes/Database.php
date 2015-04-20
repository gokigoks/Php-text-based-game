<?php

class Database{
	/*
	**

		Database class

	* 	*/

	private $options = array(
    PDO::ATTR_PERSISTENT => true, 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

	/**
	*	@var dsn credentials
	*
	*
	**/
    private $dsn = "mysql:host=localhost;port=3306;dbname=game";

	private $_connection;

	private static $_instance;	


	public function __construct(){
		
		try{

		$this->_connection = new PDO($this->dsn,"root","eldrin123",$this->options);

		}

		catch(PDOException $e) {
    	echo $e->getMessage();
		}

	}

	/*
	**
	*
	* returns a singleton instance of the database
	*/
	
	public static function getInstance(){

		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/*
	*
	*@returns the static connection
	*
	**/

	public function getConnection(){

		return $this->_connection;

	}


	public function __clone(){ 
		//empty to avoid duplication of connection
	}


}	