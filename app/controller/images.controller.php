<?php

require_once 'app/controller/controller.php';
require_once 'app/model/model.imagenes.php';
require_once 'app/view/admin.view.php';

class images_controller extends controller{

    private $model;
    private $view;

    function __construct(){
        $this->model = new model_imagenes();
        $this->view = new admin_view(true, $this->username());
    }

    function init($params){

        try{
            $id = $params[':id'];
            $action = $params[':action'] . "_image";
            $this->$action($id);
        } catch (Exception $e) {
            $this->view->error_param();
        }

    }

    function images_upload($add){
		$flags = array();
		if ($add && isset($_FILES) && (!empty($_FILES)) ){
			for($i = 0; $i<count($_FILES["foto"]["name"]);$i++){
				if(strpos($_FILES["foto"]["type"][$i],"image/") !== false){
					$img = $this->model->add($add,$_FILES["foto"]["tmp_name"][$i],$_FILES["foto"]["name"][$i]);
					if (!$img){
						//flag "upload": falla en la subida del archivo
						$flags["upload"] = true;
					}
				} else {
					//flag "type": El archivo no es un tipo admitido (imagen)
					$flags["type"] = true;
				}
			}
		} else if(! $add) {
			$this->view->error_param();die;
		} else {
			//flag "none": No se subió ningún archivo.
			$flags["none"] = true;
		}

		return ($flags);
    }

    function upload($id_f){
        $id = $this->model->get_persona($id_f);
        if (isset($_FILES) && (!empty($_FILES)) ){
            if(strpos($_FILES["foto"]["type"],"image/") !== false){
                $img = $this->model->add($id,$_FILES["foto"]["tmp_name"],$_FILES["foto"]["name"]);
                return ($img);
            }
        }
        return false;
    }
    
    function delete_image($id){

        $result = $this->model->delete_img($id);

        ($result) ? $this->view->action_done() : $this->view->error_param();

        header("reload:1");

    }

    function principal_image($id){

        $result = $this->model->set_principal($id);
        ($result) ? $this->view->action_done() : $this->view->error_param();

        header("reload:1");

    }

    function replace_image($old){

        $new = $this->upload($old);
        $result = $this->model->replace_image($old,$new);
        ($result) ? $this->view->action_done() : $this->view->error_param();

    }

}