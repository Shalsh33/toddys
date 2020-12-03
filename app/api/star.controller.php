<?php

require_once 'app/model/model.star.php';
require_once 'app/api/api.view.php';
require_once 'app/controller/controller.php';

class star_controller extends controller{

    private $model;
    private $view;
    private $data;

    function __construct(){
        $this->model = new stars_model();
		$this->view = new api_view();
		$this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }
    
    function getAVG($params){
        $persona = $params[':persona'];
        $avg = $this->model->getAVG($persona);
        if ($avg) {
            $this->view->response($avg,200);
        } else {
            $exist = $this->model->exist('persona','nombre',$persona);
            $code = ($exist) ? 200 : 404;
            $this->view->response(0,$code);
        }
    }

    function add($params){
        $persona = $params[':persona'];
        $request = $this->getData();
        if($request->estrellas){
            $stars = $request->estrellas;
            if(! isset($_SESSION)){
                session_start();
            }
            $user = $_SESSION['id'];
            $result = $this->model->add($stars,$user,$persona);
            ($result) ? $this->view->response($result,200) : $this->view->response($result,500); 
			
        } else{
            $this->view->response(false,204);
        }
    }

    function get($params){
        $persona = $params[':persona'];
        if(!isset($_SESSION)){
            session_start();
        }
        $user = $_SESSION['id'];
        $value = $this->model->valor($user,$persona);
        $this->view->response($value,200);
    }

}