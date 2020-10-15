<?php
require_once 'app/model/database.php';

class model_users extends data_base_connect {
	
	private $table;
	
	function __construct(){
		$this->table = "users";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
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
	
	function get_one($id){
		
		$query = $this->db->prepare("SELECT id, user, email, role FROM $this->table WHERE id = ?");
		$query->execute([$id]);
		
		$result = $query->fetch(PDO::FETCH_OBJ);
		return ($result);
		
	}
	
	function add($user,$pass,$email,$role){
		
		$query = $this->db->prepare("INSERT INTO $this->table (user, pass, role) VALUES (?,?,?,?)");
		$result = $query->execute([$user,$pass,$email,$role]);
		
		return ($result);
		
	}
	
	function edit($email,$role){
		
		$query = $this->db->prepare("UPDATE $this->table SET role = ? WHERE email = ? ");
		$result = $query->execute([$role,$email]);
		
		return ($result);
		
	}
	
	function delete_user($email){
		
		$query = $this->db->prepare("DELETE FROM $this->table WHERE email = ? ");
		$result = $query->execute([$email]);
		
		return ($result);
		
	}
	
}