<?php

include_once 'app/model/database.php';

//El model hereda atributos y funciones de db_conect
class stars_model extends data_base_connect{

    private $table;

    function __construct(){
        $this->table = 'star';
        parent::__construct();
    }

    function getAVG($persona){

        
        $sql = "SELECT avg(valor) AS prom FROM $this->table INNER JOIN persona ON $this->table.id_persona = persona.id WHERE persona.nombre = ?";
        
        $query = $this->db->prepare($sql);
        $query->execute([$persona]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    function add($valor,$user,$persona){

        $exist = $this->valor($user,$persona);
        if($exist){
            $sql = "UPDATE $this->table SET valor = ? WHERE id_user = ? AND id_persona = ?";
        } else {
            $sql = "INSERT INTO $this->table (valor, id_user, id_persona) VALUES (?, ?, ?)";
        }

        $query = $this->db->prepare($sql);
        $query->execute([$valor,$user,$exist->id]);

        return $query;
    }

    private function id_persona($nombre){
        $sql = "SELECT id FROM persona WHERE nombre = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$nombre]);
        $response = $query->fetch(PDO::FETCH_OBJ);

        return ($response) ? $response->id : 0;
    }

    function valor($user,$persona){
        
        $id_persona = $this->id_persona($persona);
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id_user = ? AND id_persona = ?");
        $query->execute([$user,$id_persona]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        return ($result);
    }
}