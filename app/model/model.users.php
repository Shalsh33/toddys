<?php
require_once 'app/model/database.php';

class model_users extends data_base_connect {
	
	private $table;
	
	function __construct(){
		$this->table = "users";
		parent::__construct();
	}
	
	function get_all(){
		
		$query = $this->db->prepare("SELECT id, user, email, role FROM $this->table");
		$query->execute();
		
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
		
	}
	
	function get($user){
		
		$query = $this->db->prepare("SELECT * FROM $this->table WHERE user = ?");
		$query->execute([$user]);
		
		$result = $query->fetch(PDO::FETCH_OBJ);
		return ($result);
		
	}
	//Get se usa para comparar las contraseñas al momento del login.
	//Get one se usa para el form de edit (En ningún momento necesitamos la pass del usuario)
	function get_one($id){
		
		$query = $this->db->prepare("SELECT id, user, email, role FROM $this->table WHERE id = ?");
		$query->execute([$id]);
		
		$result = $query->fetch(PDO::FETCH_OBJ);
		return ($result);
		
	}
	
	function add($user,$pass,$email,$role){
		
		$query = $this->db->prepare("INSERT INTO $this->table (user, pass, email, role) VALUES (?,?,?,?)");
		$result = $query->execute([$user,$pass,$email,$role]);
		
		return ($result);
		
	}
	
	function edit($id,$role){
		
		$query = $this->db->prepare("UPDATE $this->table SET role = ? WHERE id = ? ");
		$result = $query->execute([$role,$id]);
		
		return ($result);
		
	}
	
	function delete_user($id){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE id = ? ");
		$result = $query->execute([$id]);
		
		return ($result);
		
	}
	
}