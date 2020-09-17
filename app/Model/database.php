<?php

class data_base_connect{
	
	protected $db;
	
	protected function __construct($host,$dbname){
		$this->db = $this->connect($host,$dbname);
	}
	
	private function connect($host,$dbname){
		try{
			$connection = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', 'root', '');
			return $connection;
		}catch (PDOException $e) {
			echo "¡Error!: " . $e->getMessage();
			die();
		}
	}
	
}
?>