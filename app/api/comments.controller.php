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
	
	//Camino por defecto si la ruta se especifica mal

	function wrong_path(){

		$this->view->response("false",404);

	}

	/*
	Obtiene todos los comentarios (Para la vista administrador) o los de un usuario en específico (Para la admin view personal)
	*/
	function getAll($params = null){
		
		if ((!(isset($_GET) || $_GET['user'] == 'all')) ){ //Si estoy pidiendo todos los comentarios, tengo que tener permisos de super admin
			if ($this->permissions > 1){
				$comments = $this->model->getAll();
				($comments) ? $this->view->response($comments,200) : $this->view->response(false,500);
			} else {
				$this->view->response(false,403);
			}
		} else {
			$user = $_GET['user'];
			$comments = $this->model->getAllUser($user);
		}

		/*if (isset($_GET['persona'])){ //Consigo los específicos de una persona

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

		}*/
		
	}
	
	/*
	Obtiene todos los comentarios de un usuario por su ID (Es lo que la admin page de Users va a mostrar a los no admins)
	*/
	function getGroup($params = null){
		
		if ($params){
			$persona = $params[':persona'];
			$persona = str_replace(' ', '+', $persona);
			$comments = $this->model->getAllPersona($persona);
			if ($comments) {
				$this->view->response($comments,200);
			} else {
				$exist = $this->model->exist('persona','normalizedName',$persona);
				$code = ($exist) ? 200 : 404;
				$this->view->response(false,$code); //Si existe el usuario, devuelve "false" con un código 200, sino, "false" con 404
			}
		} else {
			$this->view->response(false,404);
		}
		
	}
	
	//agrega un comentario
	function add ($params = null){
		
		if($params){
			$persona = $params[':persona'];
			$persona = str_replace(' ', '+', $persona);
			$request = $this->getData();
			if ($request->user && $request->content){
				$comment = $request->content;
				$user = $request->user;
				$result = $this->model->add($comment,$user,$persona);
				($result) ? $this->view->response($result,201) : $this->view->response($result,418); //418: soy una tetera ☺
			} else{
				$this->view->response(false,204);
			}
			
		}

	}
	
	//Borra todos los comentarios de una persona (Función cascada de borrado de personas)
	function deletePersonaComments($params = null){

		if ($params){
			$persona = $params[':persona'];
			$persona = str_replace(' ', '+', $persona);
			if ($this->permissions>0){
				$result = $this->model->deletePersona($persona);
				($result) ? $this->view->response(true,200) : $this->view->response(false,404);
			} else {
				$this->view->response(false,403);
			}
		}
		
	}
	
	//Obtiene un solo comentario
	function getOne($params = null){
		
		if ($params){
			$user = $params[':user'];
			$idComment = $params[':comment'];
			$result = $this->model->getOne($user,$idComment);
			($result) ? $this->view->response($result,200) : $this->view->response(false,404);
		} else {
			$this->view->response(false,404);
		}
	}
	//Modifica el comentario
	function edit($params = null){

		if($params){
			$id = $params[':comment'];
			$user = $params[':user'];
			$body = json_decode($this->data);
			$result = $this->model->edit($id,$body->content,$user,$body->persona);
			($result) ? $this->view->response($result,200) : $this->view->response($result,404);
		} else {
			$this->view->response(false,404);
		}
	}
	//Elimina el comentario
	function deleteComment($params = null){
		
		if($params){
			$id = $params[':comment'];
			$user = $params[':user'];

			if ($this->permissions>1 || $this->compareSession($user)){
				$result = $this->model->deleteComment($id);
				($result) ? $this->view->response($result,200) : $this->view->response($result,404);
			} else {
				$this->view->response(false,403);
			}
		} else {
			$this->view->response(false,404);
		}
	}
	
	
}