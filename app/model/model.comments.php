<?php
require_once 'app/model/database.php';

class comments_model extends data_base_connect{

    private $table;

    function __construct(){
        
        $this->table = "comentarios";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);

    }

    function getAll($user){

        $query = $this->db->prepare("SELECT * FROM $this->table INNER JOIN users ON users.id = $this->table.id_user WHERE users.id = ? ");
        $query->execute([$user]);

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        return ($response);

    }

}