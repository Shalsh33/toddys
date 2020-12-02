<?php

include_once 'app/model/database.php';

class model_imagenes extends data_base_connect{

    private $table;
	
	function __construct(){
		//Defino El host, los datos de la db y la tabla que vamos a usar
		$this->table = "imagen";
		parent::__construct();
    }

    function get_persona($id){

        $query = $this->db->prepare("SELECT id_persona FROM $this->table WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result->id_persona;

    }

    function get_all_persona($id){

        
        $query = $this->db->prepare("SELECT $this->table.* FROM $this->table INNER JOIN persona ON $this->table.id_persona = persona.id WHERE persona.nombre = ? OR persona.id = ? ORDER BY principal");
        $query->execute([$id,$id]);

        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;

    }

    function add($id,$tempName,$file){

        $filepath = "includes/img/uploaded/" . uniqid("", true) . "." . strtolower(pathinfo($file, PATHINFO_EXTENSION));
        move_uploaded_file($tempName, $filepath);

        $query = $this->db->prepare("INSERT INTO $this->table (nombre,id_persona,principal) VALUES (?,?,?)");
        $result = $query->execute([$filepath,$id,false]);

        return ($result) ? $filepath : false;

    }

    function set_principal($id){

        try{

            $idp = $this->db->prepare("SELECT id_persona FROM $this->table WHERE id = ?");
            $idp->execute([$id]);
            $idp = $idp->fetch(PDO::FETCH_OBJ);

            $this->db->beginTransaction(); //Inicio una transacción
            $remove = $this->db->prepare("UPDATE $this->table SET principal = ? WHERE id_persona = ? AND principal");
            $remove->execute([false,$idp->id_persona]); //Remuevo la imagen principal
            if(!$remove){ //Si existe algún error, se lanza una exception para deshacer la transacción
                throw new Exception("Error actualizando columnas");
            }
            $query = $this->db->prepare("UPDATE $this->table SET principal = ? WHERE id = ?");
            $result = $query->execute([true,$id]);

            ($result) ? $this->db->commit() : $this->db->rollBack();

            return ($result);

        } catch (Exception $e){
            $this->db->rollBack();
            return false;
        }

    }

    function get_principal($id){

        try{
            $query = $this->db->prepare("SELECT * FROM $this->table WHERE id_persona = ? AND principal");
            $query->execute([$id]);

            $response = $query->fetch(PDO::FETCH_OBJ);

            return $response;
        } catch (Exception $e){
            return false;
        }
    }

    function delete_img($id){

        $path = $this->get_path($id);
        if($path){
            $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
            $response = $query->execute([$id]);
            if ($response){
                unlink($path);
            }
        } else {
            $response = false;
        }

        return ($response);
    }

    private function get_path($id){

        $query = $this->db->prepare("SELECT nombre FROM $this->table WHERE id = ?");
        $query->execute([$id]);
        $response = $query->fetch(PDO::FETCH_OBJ);

        return ($response->nombre);
    }

    function replace_image($old,$new){

        $query = $this->db->prepare("UPDATE $this->table SET principal = ? WHERE nombre = ?");
        $query = $query->execute([true,$new]);
        $result = ($query) ?  $this->delete_img($old) :  false;

        return $result;
    }
}