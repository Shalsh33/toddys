<?php
require_once 'app/model/database.php';

class comments_model extends data_base_connect{

    private $table;

    function __construct(){
        
        $this->table = "comments";
		$host = "localhost";
		$dbname = "bloque_de_todos";
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$user = "root";
		$pass = "";
		parent::__construct($dsn,$user,$pass);

    }

    function exist($table,$search,$value){

        //Return values
        $true = 200;
        $false = 404;

        $sql = "SELECT $table.* FROM $table
        WHERE $table.$search = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$value]);

        $response = $query->fetch(PDO::FETCH_OBJ);

        return ($response) ? $true : $false;

    }

    function getAll(){

        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->excecute([]);

        $response = $query->fetchAll(PDO::FETCH_OBJ);
        return ($response);

    }

    function getAllPersona($normalizedName){

        $sql = "SELECT 
        $this->table.id, $this->table.content, $this->table.date,
        users.email FROM $this->table
        INNER JOIN users ON users.id = $this->table.id_user 
        INNER JOIN persona ON persona.id = $this->table.id_persona
        WHERE persona.normalizedName = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$normalizedName]);

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        return ($response);

    }

    /*
    Obtiene todos los comentarios de un usuario en específico
    */
    function getAllUser($user){

        $sql = "SELECT 
        $this->table.id, $this->table.content, $this->table.date,
        persona.nombre, users.email FROM $this->table
        INNER JOIN users ON users.id = $this->table.id_user 
        INNER JOIN persona ON persona.id = $this->table.id_persona
        WHERE users.id = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$user]);

        $response = $query->fetchAll(PDO::FETCH_OBJ);

        return ($response);

    }

    function add($comment,$user,$persona){

        $query = $this->db->prepare("INSERT INTO $this->table (`content`, `date`, `id_user`, `id_persona`) VALUES (?,?,?,?)");
        $date = new DateTime('now',new DateTimeZone('America/Buenos_Aires'));
        $params = array ($comment,$date->format('Y-m-d h:i:s'),$user,$persona);
        $result = $query->execute($params);

        return ($result);

    }

}