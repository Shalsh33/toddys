<?php

require_once 'app/model/model.comments.php';
require_once 'app/api/api.view.php';
require_once 'app/controller/controller.php';

class comments_controller extends controller{
	
	private $model;
	private $view;
	private $data;
	private $permissions;
	
	function __construct(){
		
		$this->model = new comments_model();
		$this->view = new api_view();
		$this->data = file_get_contents("php://input");
		session_start();
		$this->permissions = $this->permissionsLevel();
		
	}
	
	private function getData(){
		
		return json_decode($this->data);
		
	}
	
	function wrong_path(){

		$this->view->response("false",404);

	}

	/*
	Obtiene todos los comentarios (Para la vista administrador) o los de una persona en específico (Para la index view)
	*/
	function getAll($params = null){
		
		if (isset($_GET['persona'])){ //Consigo los específicos de una persona

			$name = $_GET['persona'];
			$name = str_replace(' ', '+', $name);
			$comments = $this->model->getAllPersona($name);
			if ($comments){ //Si tiene comentarios
				$this->view->response($comments,200); //Los devuelvo
			 } else {
				$code = $this->model->exist('persona','normalizedName',$name);
				$this->view->response(false,$code); //Si no tiene comentarios, me fijo que exista la persona (para saber el código de respuesta)
			}
		} else { //Sino, pido todos los comentarios para el admin
			if ($this->permissions > 0){ //Si el usuario tiene permisos +0 (Admin o superior)
				$comments = $this->model->getAll();
				($comments) ? $this->view->response($comments,200) : $this->view->response(false,404); //Pido todos los comentarios y los devuelvo
			} else {
				$this->view->response(false,403); //Sino, el usuario no tiene permisos (403 Forbidden)
			}

		}
		
	}
	
	/*
	Obtiene todos los comentarios de un usuario por su ID (Es lo que la admin page de Users va a mostrar a los no admins)
	*/
	function getGroup($params = null){
		
		if ($params){
			$user = $params[':user'];
			$comments = $this->model->getAllUser($user);
			if ($comments) {
				$this->view->response($comments,200);
			} else {
				$code = $this->model->exist('users','id',$user);
				$this->view->response($comments,$code); //Si existe el usuario, devuelve "false" con un código 200, sino, "false" con 404
			}
		} else {
			$this->view->response(false,404);
		}
		
	}
	
	function add ($params = null){
		
		if($params){
			$user = $params[':user'];
			$request = $this->getData();
			if ($request->persona && $request->content){
				$comment = $request->content;
				$persona = $request->persona;
				$result = $this->model->add($comment,$user,$persona);
				($result) ? $this->view->response($result,201) : $this->view->response($result,404);
			} else{
				$this->view->response("Solicitud incompleta",204);
			}
			
		}

	}
	
	function deleteUserComments($params = null){
		
	}
	
	function getOne($params = null){
		
	}
	
	function edit($params = null){
		if($params){
			$id = $params[':id'];
			$body = json_decode($this->data);
			$result = $this->model->edit($id,$body->content);
			($result) ? $this->view->response($result,200) : $this->view->response($result,404);
		}
	}
	
	function deleteComment($params = null){
		
	}
	
	
}