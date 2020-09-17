<?php

require_once 'app/Model/database.php'

//El admin hereda atributos y funciones de db_conect
class admin_model_concejales extends data_base_conect{
	
	private $table;
	
	private function __construct(){
		//Defino El host, la db y la tabla que vamos a usar
		$this->table = "concejales";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		parent::__construct($host,$dbname);
	}
	
	function insertar_concejal($nombre,$periodo,$desc=null,$presidente){
		
		//Si reemplazamos al presidente
		if ( ($presidente) && ($self->comprobar_existe_presidente()) ){
				$self->reemplazar_presidente();
		}
		
		// preparamos la consulta
		$query = $this->db->prepare("INSERT INTO ? (nombre, periodo, 'desc', presidente) VALUES (?,?,?,?)");
			
		//devolvemos el resultado de la ejecución (True/False)
		return ($query->execute([$this->table,$nombre,$periodo,$desc,$presidente]));
		
	}
	
	function borrar_concejal($id){
		
		$query = $this->db->prepare("DELETE FROM ? WHERE id_concejal = ?");
		
		return ($query->execute([$this->table,$id]));
	}
	
	function editar_concejal($id,$nombre,$periodo,$desc,$presidente){
		
		$query = $this->db->prepare("UPDATE ? SET nombre = ?, periodo = ?, 'desc' = ? presidente = ? WHERE id = ?");
		
		return ($query->execute([$this->table,$nombre,$periodo,$desc,$presidente,$id]));
	}
	
	
	function comprobar_existe_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM ? WHERE presidente");
		
		$query->execute([$this->table]);
		$response = $query->fetchAll();
		
		//Si hay presidente, devuelve True
		return (!empty($response));
	}
	
	private function reemplazar_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM ? WHERE presidente");
		
		$query->execute([$this->table]);
		
		//pido el array con los datos de la respuesta (sé que solo hay uno, asique puedo usar fetch)
		$response = $query->fetch(PDO->FETCH_ASSOC);
		
		$this->editar_concejal($response[id_concejal],$response[nombre],$response[periodo],$response[desc],false]); //false porque ya no es presidente
	}
	
	function obtener_concejales(){
		
		$query = $this->db->prepare("SELECT * FROM ?");
		
		$query->execute([$this->table]);
		
		$response = $query->fetchAll();
		
		return ($response);
	}
}