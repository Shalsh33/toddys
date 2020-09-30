<?php

include_once 'app/model/database.php';

//El admin hereda atributos y funciones de db_conect
class model_relaciones extends data_base_connect{
	
	private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "persona_comision";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
	}
	
	function insert($id_persona,$id_comision,$cargo){
		
		$query = $this->db->prepare("INSERT INTO $this->table (id_persona, id_comision, cargo) VALUES (?, ?, ?) ");
		
		$result = $query->execute([$id_persona,$id_comision,$cargo]);
		
		return ($result);
		
	}
	
	function delete_relacion($id_persona,$id_comision){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id_persona = ? AND id_comision = ? ");
		
		$result = $query->execute([$id_persona,$id_comision]);
		
		return ($result);
		
	}
	
	function drop_persona($id){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id_persona = ?");
		
		$result = $query->execute([$id]);
		
		return ($result);
		
	}
	
	function drop_comision($id){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id_comision = ? ");
		
		$result = $query->execute([$id]);
		
		return ($result);
		
	}
	
	function edit($id_persona,$id_comision,$cargo){
		
		$query = $this->db->prepare("UPDATE $this->table SET cargo = ? WHERE id_persona = ? AND id_comision = ? ");
		
		$result = $query->execute([$cargo,$id_persona,$id_comision]);
		
		return ($result);
		
	}
	
	function get_personas($id_comision){
		
		$query = $this->db->prepare("SELECT persona.nombre FROM $this->table INNER JOIN persona ON 
		$this->table.id_persona = persona.id WHERE $this->table.id_comision = ?;"); //recibo las personas que son parte de la comision
		
		$query->execute([$id_comision]); 
		
		$personas = $query->fetchAll(PDO::FETCH_OBJ);
		
		return ($personas);
	
	}
	
}