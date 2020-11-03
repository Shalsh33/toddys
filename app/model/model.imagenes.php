<?php

include_once 'app/model/database.php';

class model_imagenes extends data_base_connect{

    private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "imagen";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);
    }
    
    function get_all_persona($id){

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id_persona = ?");
        $query->execute([$id]);

        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;

    }

    function add($id,$tempName,$file){

        $filepath = "includes/img/uploaded/" . uniqid("", true) . "." . strtolower(pathinfo($file, PATHINFO_EXTENSION));
        move_uploaded_file($tempName, $filepath);

        $query = $this->db->prepare("INSERT INTO $this->table (nombre,id_persona) VALUES (?,?)");
        $result = $query->execute([$filepath,$id]);

        return $result;

    }
}