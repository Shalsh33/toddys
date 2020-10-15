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
	
	private function insert($id_persona,$id_comision){
		
		$query = $this->db->prepare("INSERT INTO $this->table (id_persona, id_comision) VALUES (?, ?) ");
		
		$result = $query->execute([$id_persona,$id_comision]);
		
		return ($result);
		
	}
	
	private function delete_relacion($id_persona,$id_comision){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id_persona = ? AND id_comision = ? ");
		
		$result = $query->execute([$id_persona,$id_comision]);
		
		return ($result);
		
	}
	
	private function not_in($array,$item,$index=null){
		
		foreach ($array as $element){
			
			if ($index && $element->$index == $item){
				
				return false;
				
			} elseif ($element == $item){
				
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	function set_comisiones($comisiones,$id_persona){
		
		$all = $this->get_comisiones($id_persona);
		
		foreach($comisiones as $comision){
			
			if ($this->not_in($all,$comision,'id')){ //Cuando tenga internet -> buscar si php tiene esta función
				$insert = $this->insert($id_persona,$comision);
				if (!$insert){
					return false;
					}
			}
			
		}
		
		foreach($all as $comision){
			
			if($this->not_in($comisiones,$comision->id)){
				$delete = $this->delete_relacion($id_persona,$comision->id);
				if(!$delete){
					return false;
				}
			}
			
		}
		
		return true;
	}
	
	function set_personas($personas,$id_comision){
		
		$all = $this->get_personas($id_comision);
		
		foreach($personas as $persona){
			
			if ($this->not_in($all,$persona,'id')){ //Cuando tenga internet -> buscar si php tiene esta función
				$insert = $this->insert($persona,$id_comision);
				if (!$insert){
					return false;
					}
			}
			
		}
		
		foreach($all as $persona){
			
			if($this->not_in($personas,$persona->id)){
				$delete = $this->delete_relacion($persona->id,$id_comision);
				if(!$delete){
					return false;
				}
			}
			
		}
		
		return true;
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
	
	function get_personas($id_comision){
		
		$query = $this->db->prepare("SELECT persona.nombre, persona.id FROM $this->table INNER JOIN persona ON 
		$this->table.id_persona = persona.id WHERE $this->table.id_comision = ?;"); //recibo las personas que son parte de la comision
		
		$query->execute([$id_comision]); 
		
		$personas = $query->fetchAll(PDO::FETCH_OBJ);
		
		return ($personas);
	
	}
	
	
	function get_comisiones($id_persona){
		
		$query = $this->db->prepare("SELECT comision.nombre, comision.id FROM $this->table INNER JOIN comision ON 
		$this->table.id_comision = comision.id WHERE $this->table.id_persona = ?;"); //recibo las personas que son parte de la comision
		
		$query->execute([$id_persona]); 
		
		$comisiones = $query->fetchAll(PDO::FETCH_OBJ);
		
		return ($comisiones);
	
	}

	function get_relaciones_persona($id){
		
		$query = $this->db->prepare("SELECT comision.nombre, comision.id FROM persona INNER JOIN $this->table ON $this->table.id_persona = persona.id
		INNER JOIN comision ON $this->table.id_comision = comision.id WHERE persona.id = ?"); //recibo las comisiones de una persona
		
		$query->execute([$id]);
		
		$comisiones = $query->fetchALL(PDO::FETCH_OBJ);
		
		return ($comisiones);
		
	}
	
	function get_relaciones_comision($id){
		
		$query = $this->db->prepare("SELECT persona.nombre, persona.id FROM comision INNER JOIN $this->table ON $this->table.id_comision = comision.id
		INNER JOIN persona ON $this->table.id_persona = persona.id WHERE comision.id = ?"); //recibo las personas de una comisión
		
		$query->execute([$id]);
		
		$personas = $query->fetchALL(PDO::FETCH_OBJ);
		
		return ($personas);
		
	}
	
	
}