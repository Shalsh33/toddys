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

		$this->view->response("Ruta mal especificada",404);

	}



	/*
	Obtiene todos los comentarios de un usuario por su ID (Es lo que la admin page de Users va a mostrar a los no admins)
	*/
	function getAll($params = null){
		
		if ($params){
			$persona = $params[':persona'];
			if (!isset($_GET['page'])){
				$page = 1;
			} else {
				$page = $_GET['page'];
			}
			$persona = str_replace(' ', '+', $persona); //php convierte automaticamente los + en un espacio
			$comments = $this->model->getAllPersona($persona,$page);
			if ($comments) {
				$this->view->response($comments,200);
			} else {
				$exist = $this->model->exist('persona','normalizedName',$persona);
				if ($exist){
					$code = 200;
				} else {
					$code = 404;
				}
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
			if ($request->content){
				$comment = $request->content;
				if(! isset($_SESSION)){
					session_start();
				}
				$user = $_SESSION['id'];
				$result = $this->model->add($comment,$user,$persona);
				($result) ? $this->view->response($result,201) : $this->view->response($result,418); //418: soy una tetera *.*
			} else{
				$this->view->response(false,204);
			}
			
		} else {
			$this->view->response(false,404);
		}

	}
	
	//Borra todos los comentarios de una persona (Función cascada de borrado de personas)
	function deletePersonaComments($params = null){

		if ($params){
			$persona = $params[':persona'];
			$persona = str_replace(' ', '+', $persona);
			if ($this->permissions>0){
				$result = $this->model->deletePersona($persona);
				($result) ? $this->view->response(true,200) : $this->view->response(false,500);
			} else {
				$this->view->response(false,403);
			}
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
			$result = $this->model->edit($id,$body->content,$user);
			($result) ? $this->view->response($result,200) : $this->view->response($result,500);
		} else {
			$this->view->response(false,404);
		}
	}
	//Elimina el comentario
	function deleteComment($params = null){
		
		if($params){
			try{
				$id = $params[':comment'];
				if (! is_numeric($id)){
					throw new Exception('ID del comentario mal especificada');
				}
				$user = $params[':user'];
				if (! is_numeric($user)){
					throw new Exception('ID del usuario mal especificada');
				}
				
				if ($this->permissions>1 || $this->compareSession($user)){
					$result = $this->model->deleteComment($id);
					($result) ? $this->view->response($result,200) : $this->view->response($result,500);
				} else {
					$this->view->response(false,403);
				}
			} catch (Exception $e){
				$this->view->response($e->getMessage(),404);
			}
		} else {
			$this->view->response(false,404);
		}
	}
	
	
}