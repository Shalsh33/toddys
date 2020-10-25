<?php

require_once 'app/model/model.comments.php';
require_once 'app/api/api.view.php';

class comments_controller{
	
	private $model;
	private $view;
	private $data;
	
	function __construct(){
		
		$this->model = new comments_model();
		$this->view = new api_view();
		$this->data = file_get_contents("php://input");
		session_start();
		
	}
	
	private function getData(){
		
		return json_decode($this->data);
		
	}
	
	function getAll($params = null){
		
		
		
	}
	
	function getGroup($params = null){
		
		if ($params){
			$comments = $this->model->getAll($params[':user']);
			($comments) ? $this->view->response($comments,200) : $this->view->response($comments,404);
		} else {
			$this->view->response(false,404);
		}
		
	}
	
	function add ($params = null){
		
	}
	
	function deleteUserComments($params = null){
		
	}
	
	function getOne($params = null){
		
	}
	
	function edit($params = null){
		
	}
	
	function deleteComment($params = null){
		
	}
	
	
}