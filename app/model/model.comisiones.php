<?php

include_once 'app/model/database.php';

//El model hereda atributos y funciones de db_conect
class model_comisiones extends data_base_connect{
	
	private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "comision";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
	}
	
	function insert_comision($nombre,$fecha){
		
		//Si la comisión ya está ingresada
		
		$id = $this->exist($nombre);
		
		if ($id){
			return $id;
		}
		// preparamos la consulta
		$query = $this->db->prepare("INSERT INTO $this->table (nombre, fecha) VALUES (?,?)");
			//La consulta tiene que llevar el nombre de la tabla, sino no se ejecuta!
			
		//devolvemos el resultado de la ejecución (True/False)
		$result = $query->execute([$nombre,$fecha]); 
		return ($result);
		
	}
	
	function delete_comision($id=null,$nombre=null){
		
		if (! ($id || $nombre)){
			return false;
		} else if ($nombre) {
			$id = $this->exist($nombre);
		}
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
		
		$result = $query->execute([$id]);
		
		return($result);
	}
	
	function edit_comision($id,$nombre,$fecha){
		
		$query = $this->db->prepare("UPDATE $this->table SET nombre = ?, fecha = ? WHERE id = ?");
		
		$result = $query->execute([$nombre,$fecha,$id]);
		
		return($result);
	}
	
	
	function exist($nombre){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE nombre = ?");
		
		$query->execute([$nombre]);
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		return (empty(response)) ? null : (response[id]);
	}
	
	function get_comisiones(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
	
		return ($response);
	}
	
	function get_one($id){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
		
		$query->execute([$id]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		return($response);
		
	}
}