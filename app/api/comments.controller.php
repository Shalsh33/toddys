<?php

require_once 'app/model/model.comments.php';
require_once 'app/api/api.view.php';

class comments_controller{
	
	private $model;
	private $view;
	
	function __construct(){
		
		//$this->model = new comments_model();
		//$this->view = new api_view();
		session_start();
		
	}
	
	function getAll($params = null){
		
	}
	
	function getGroup($params = null){
		
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