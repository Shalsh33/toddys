<?php

class data_base_connect{
	
	protected $db;
	
	protected function __construct($host,$dbname,$user,$pass){
		$this->db = $this->connect($host,$dbname,$user,$pass);
	}
	
	private function connect($host,$dbname,$user,$pass){
		try{
			$connection = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
			return $connection;
		}catch (PDOException $e) {
			echo "¡Error!: " . $e->getMessage();
			die();
		}
	}
	
}
?>