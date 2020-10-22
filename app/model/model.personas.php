<?php

include_once 'app/model/database.php';
require_once 'app/model/model.relaciones.php';

//El admin hereda atributos y funciones de db_conect
class model_personas extends data_base_connect{
	
	private $table;
	private $relaciones;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->relaciones = new model_relaciones();
		$this->table = "persona";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
	}
	
	private function normalize($nombre){
		
		$nombre = str_replace(' ', '+', $nombre);
		$nombre = str_replace('á', 'a', $nombre);
		$nombre = str_replace('é', 'e', $nombre);
		$nombre = str_replace('í', 'i', $nombre);
		$nombre = str_replace('ó', 'o', $nombre);
		$nombre = str_replace('ú', 'u', $nombre);
		return($nombre);
		
	}
	
	function insert($nombre,$periodo,$desc=null,$presidente,$foto="none.png"){
		
		//Si reemplazamos al presidente
		if ( ($presidente) && ($self->check_presidente()) ){
				$self->replace_presidente();
		}
		$normalizedName = $this->normalize($nombre);
		// preparamos la consulta
		$query = $this->db->prepare("INSERT INTO $this->table (nombre, periodo, descripcion, presidente, foto, normalizedName) VALUES (?,?,?,?,?,?)");
			//La consulta tiene que llevar el nombre de la tabla, sino no se ejecuta!
		
		$result = $query->execute([$nombre,$periodo,$desc,$presidente,$foto,$normalizedName]);
			
		//devolvemos el resultado de la ejecución (True/False)
		return ($result);
		
	}
	
	function delete_persona($id){
		
		$this->relaciones->drop_persona($id); //para no generar un error de foreing key, primero se debe borrar las relaciones (si las hay)
		
		//y luego procedo a borrar a la persona
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
		
		$result = $query->execute([$id]);
		
		return($result);
	}
	
	function edit($id,$persona){
		
		if($persona['presidente'] && ($this->check_presidente())){
			$result = $this->replace_presidente();
			if (!($result)) {
				return false;
			}
		}
		
		$query = $this->db->prepare("UPDATE $this->table SET nombre = ?, periodo = ?, descripcion = ?, presidente = ?, foto = ?, normalizedName = ? WHERE id = ?");
		$normalizedName = $this->normalize($persona['nombre']);
		$result = $query->execute([$persona['nombre'],$persona['periodo'],$persona['descripcion'],$persona['presidente'],$persona['foto'],$normalizedName,$id]);
		
		return($result);
	}
	
	
	private function check_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE presidente");
		
		$query->execute();
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		//Si hay presidente, devuelve True
		return (!empty($response));
	}
	
	private function replace_presidente(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE presidente");
		
		$query->execute();
		
		//pido el array con los datos de la respuesta (sé que solo hay uno, asique puedo usar fetch)
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		$query = $this->db->prepare("UPDATE $this->table SET presidente = ? WHERE id = ?");
		$result = $query->execute([false,$response->id]);
		
		return ($result);
	}
	
	function get_all(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
	
		return ($response);
	}
	
	function get_all_extended(){
		
		$query = $this->db->prepare("SELECT * FROM $this->table");
		
		$query->execute();
		
		$response = $query->fetchAll(PDO::FETCH_OBJ);
		
		for($i=0;$i<count($response);$i++){
			
			$persona = $response[$i];
			
			$comisiones = $this->relaciones->get_comisiones($persona->id);
			
			$persona->comisiones = $comisiones;
			
		}
	
		return ($response);
	}
	
	function get_one($id){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
		
		$query->execute([$id]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		return($response);
	}
	
	function get_one_extended($id){
		//Intentamos conseguir la persona por ID
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
		
		$query->execute([$id]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		if (!$response){
			//Si no hay respuesta, probamos si el id en realidad no es un nombre
			$response = $this->get_by_name($id);
		}
		//Si existe, vamos a asignarle las comisiones
		if ($response){
			$comisiones = $this->relaciones->get_comisiones($id);
			$response->comisiones = $comisiones;
		}
		
		return($response);
	}
	
	function get_by_name($name){
		//Intentamos obtener la persona por Nombre Normalizado
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE normalizedName = ?");
		$name = $this->normalize($name);
		$query->execute([$name]);
		
		$response = $query->fetch(PDO::FETCH_OBJ);
		
		return($response);
		
	}
	function equal($persona,$id){
		
		$compare = $this->get_one($id);
		
		if ($persona['nombre'] == $compare->nombre && $persona['periodo'] == $compare->periodo && $persona['descripcion'] == $compare->descripcion && $persona['foto'] == $compare->foto && ($persona['presidente'] == $compare->presidente) ){
			return true;
		}
		return false;
		
	}
	
}