<?php
require_once 'app/model/database.php';
require_once 'app/model/model.personas.php';

class comments_model extends data_base_connect{

    private $table;
    private $personas;
    private $limit;

    function __construct(){
        
        $this->table = "comments";
        $this->personas = new model_personas();
        $this->limit = 10;
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

    function getAllPersona($normalizedName,$page){

        $offset = ($page-1)*$this->limit;

        $sql = "SELECT 
        $this->table.*, users.user FROM $this->table
        INNER JOIN users ON users.id = $this->table.id_user 
        INNER JOIN persona ON persona.id = $this->table.id_persona
        WHERE persona.normalizedName = ? ORDER BY date DESC LIMIT $offset,$this->limit"; //se declara el limite en la consulta, sino falla

       
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

        return ($response) ? $response : $this->exist('users','id',$user);

    }

    function add($comment,$user,$persona){

        $id_persona = $this->personas->normalized_to_id($persona);
        $query = $this->db->prepare("INSERT INTO $this->table (`content`, `date`, `id_user`, `id_persona`) VALUES (?,?,?,?)");
        $date = new DateTime('now',new DateTimeZone('America/Buenos_Aires'));
        $params = array ($comment,$date->format('Y-m-d H:i:s'),$user,$id_persona);
        $result = $query->execute($params);
        $obj = ($result) ?
        (object) array ('id' => $this->db->lastInsertId(), 'content' => $comment, 'date' => $date->format('Y-m-d H:i:s'), 
        'id_user' => $user, 'id_persona' => $id_persona, 'edited' => false) : false;

        return ($obj);

    }

    function edit($id,$comment,$id_user,$id_persona){

        $query = $this->db->prepare("UPDATE $this->table SET (`content`, `edited`, `date_edited`) VALUES (?,?,?) WHERE id = ? AND id_user = ? AND id_persona = ?");
        $date = new DateTime('now',new DateTimeZone('America/Buenos_Aires'));
        $result = $query->execute([$comment,true,$date->format('Y-m-d H:i:s'),$id,$id_user,$id_persona]);
        return ($result) ? $this->getOne($id_user,$id) : false;
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

    function deleteComment($id){

        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $result = $query->execute([$id]);

        return ($result);
    }
}