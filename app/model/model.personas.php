<?php

include_once 'app/model/database.php';

//El admin hereda atributos y funciones de db_conect
class admin_model_personas extends data_base_connect{
	
	private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "persona";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$user = "root";
		$pass = "";
		parent::__construct($host,$dbname,$user,$pass);
	}
	
	function insertar_persona($nombre,$periodo,$desc=null,$presidente){
		
		//Si reemplazamos al presidente
		if ( ($presidente) && ($self->comprobar_existe_presidente()) ){
				$self->reemplazar_presidente();
		}
		
		// preparamos la consulta
		$query = $this->db->prepare("INSERT INTO $this->table (nombre, periodo, descripcion, presidente) VALUES (?,?,?,?)");
			//La consulta tiene que llevar el nombre de la tabla, sino no se ejecuta!
			
		//devolvemos el resultado de la ejecución (True/False)
		return ($query->execute([$nombre,$periodo,$desc,$presidente]));
		
	}
	
	function borrar_persona($id){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
		
		$result = $query->execute([$id]);
		
		return($result);
	}
	
	function editar_persona($id,$nombre,$periodo,$desc,$presidente,$foto){
		
		if( $presidente && ($this->comprobar_existe_presidente())){
			$this->reemplazar_presidente();
		}
		
		$query = $this->db->prepare("UPDATE $this->table SET nombre = ?, periodo = ?, descripcion = ?, presidente = ?, foto = ? WHERE id = ?");
		
		$result = $query->execute([$nombre,$periodo,$desc,$presidente,$foto,$id]);
		
		return($result);
	}
	
	
	function comprobar_existe_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE presidente");
		
		$query->execute();
		$response = $query->fetchAll();
		
		//Si hay presidente, devuelve True
		return (!empty($response));
	}
	
	private function reemplazar_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE presidente");
		
		$query->execute();
		
		//pido el array con los datos de la respuesta (sé que solo hay uno, asique puedo usar fetch)
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		$this->editar_persona($response->id,$response->nombre,$response->periodo,$response->descripcion,false,$response->foto); //false porque ya no es presidente
	}
	
	function obtener_personas(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
	
		return ($response);
	}
	
	function obtener_uno($id){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
		
		$query->execute([$id]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		return($response);
		
	}
}