<?php

include_once 'app/model/database.php';
require_once 'app/model/model.relaciones.php';

//El model hereda atributos y funciones de db_conect
class model_comisiones extends data_base_connect{
	
	private $table;
	private $relaciones;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->relaciones = new model_relaciones();
		$this->table = "comision";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
	}
	
	function insert($nombre,$fecha){
		
		// preparamos la consulta
		$query = $this->db->prepare("INSERT INTO $this->table (nombre, fecha_de_reunion) VALUES (?,?)");
		
		//devolvemos el resultado de la ejecución (True/False)
		$result = $query->execute([$nombre,$fecha]); 
		return ($result);
		
	}
	
	function delete_comision($id){
		
		$this->relaciones->drop_comision($id);
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
		
		$result = $query->execute([$id]);
		
		return($result);
	}
	
	function edit($id,$comision){
		
		$query = $this->db->prepare("UPDATE $this->table SET nombre = ?, fecha_de_reunion = ? WHERE id = ?");
		
		$result = $query->execute([$comision['nombre'],$comision['fecha'],$id]);
		
		return($result);
	}
		
	function get_all(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
	
		return ($response);
	}
	
	function get_all_extended(){ //recibe las comisiones y los miembros de cada una
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
		
		foreach($response as $comision){
			
			$personas = $this->relaciones->get_personas($comision->id);
			
			$comision->personas = $personas;
			
		}
	
		return ($response);
	}
	
	
	function get_one($id){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
		
		$query->execute([$id]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		$response->personas = $this->relaciones->get_personas($response->id);
		
		return($response);
		
	}
}