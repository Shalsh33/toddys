<?php

class data_base_connect{
	
	protected $db;
	
	protected function __construct($dsn,$user,$pass){
		$this->db = $this->connect($host,$dbname,$user,$pass);
	}
	
	private function connect($dsn,$user,$pass){
		try{
			$connection = new PDO($dsn, $user, $pass);
			return $connection;
		}catch (PDOException $error) {
			return NULL;
		}
	}
	
}