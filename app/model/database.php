<?php

class data_base_connect{
	
	protected $db;
	
	protected function __construct($dsn = null, $user = null, $pass = null){
		if (!$dsn){
			$host = "localhost";
			$dbname = "bloque_de_todos";
			$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
			$user = "root";
			$pass = "";
		}
		$this->db = $this->connect($dsn,$user,$pass);
	}
	
	private function connect($dsn,$user,$pass){
		try{
			$connection = new PDO($dsn, $user, $pass);
			return $connection;
		}catch (PDOException $error) {
			return null;
		}
	}
	
	function check_connection (){
		
		return ($this->db) ? true : false;
		
	}

	function exist($table,$search,$value){

        
        $sql = "SELECT $table.* FROM $table
        WHERE $table.$search = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$value]);

        $response = $query->fetch(PDO::FETCH_OBJ);

        return ($response) ? true : false;

    }
	
}