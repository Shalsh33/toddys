<?php

include_once 'app/model/database.php';

class model_imagenes extends data_base_connect{

    private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "imagen";
		parent::__construct();
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

        $query = $this->db->prepare("INSERT INTO $this->table (nombre,id_persona,principal) VALUES (?,?,?)");
        $result = $query->execute([$filepath,$id,false]);

        return $result;

    }

    function set_principal($id){

        try{

            $idp = $this->db->prepare("SELECT id_persona FROM $this->table WHERE id = ?");
            $idp->execute([$id]);
            $idp = $idp->fetchAll(PDO::FETCH_OBJ);
            $this->db->beginTransaction();
            $remove = $this->db->prepare("UPDATE $this->table SET principal = ? WHERE id_persona = ?");
            $remove->execute([false,$idp]);
            if(!$remove){
                throw new Exception("Error actualizando columnas");
            }
            $query = $this->db->prepare("UPDATE $this->table SET principal = ? WHERE id = ?");
            $result = $query->execute([true,$id]);
            $this->db->commit();

            return ($result);

        } catch (Exception $e){
            $this->db->rollBack();
            return false;
        }

    }
}