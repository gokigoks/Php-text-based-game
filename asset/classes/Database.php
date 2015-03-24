<?php

class Database{

	private $options = array(
    PDO::ATTR_PERSISTENT => true, 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    protected $dsn = "mysql:host=localhost;port=3306;dbname=game";

	private $_connection;
	private static $_instance;	

	public static function getInstance(){

		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){
		try{
		$this->_connection = new PDO($this->dsn,"root","eldrin123",$this->options);
		}
		catch(PDOException $e) {
    	echo $e->getMessage();
		}
	}

	private function __clone(){ 
		//empty to avoid duplication of connection
	}

	public function getConnection(){
		return $this->_connection;
	}



}	