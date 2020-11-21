<?php
require_once 'app/model/database.php';

class comments_model extends data_base_connect{

    private $table;

    function __construct(){
        
        $this->table = "comments";
		parent::__construct();

    }

    function exist($table,$search,$value){

        
        $sql = "SELECT $table.* FROM $table
        WHERE $table.$search = ?";

        $query = $this->db->prepare($sql);
        $query->execute([$value]);

        $response = $query->fetch(PDO::FETCH_OBJ);

        return ($response) ? true : false;

    }

    function getAll(){

        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute([]);

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

    function edit($id,$comment,$id_user,$id_persona){

        $query = $this->db->prepare("UPDATE $this->table SET (`content`, `edited`, `date_edited`) VALUES (?,?,?) WHERE id = ? AND id_user = ? AND id_persona = ?");
        $date = new DateTime('now',new DateTimeZone('America/Buenos_Aires'));
        $result = $query->execute([$comment,true,$date->format('Y-m-d h:i:s'),$id,$id_user,$id_persona]);
        return $result;
    }

    function getOne($user,$id){
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id = ? AND id_user = ?");
        $query->execute([$id,$user]);
        $result =  $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    function deletePersona($persona){

        $query = $this->db->prepare("DELETE FROM $this->table INNER JOIN persona ON $this->table.id_persona = persona.id WHERE persona.normalizedName = ?");
        $result = $query->execute([$persona]);

        return ($result);
    }

}