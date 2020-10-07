<?php
	
require_once "app/controller/controller.php";
require_once "app/model/model.users.php";
require_once "app/view/auth.view.php";
	
class auth_controller extends controller {
	
	protected $view;
	protected $model;
	
	function __construct(){
		
		$sesion = $this->sesion();
		$this->view = ($sesion) ? new auth_view($sesion, $this->username()) : new auth_view($sesion);
		$this->model = new model_users();
		$this->check_session();
		
	}
	
	function check_session(){
		
		session_start();
		if (isset($_SESSION['user'])){
			header('location: ' . BASE_URL . 'admin');
			die();
		}
		
	}
	
	function init(){
		
		$this->view->init();
		
	}
	
	function login(){
		
		if (isset($_POST['user']) && isset($_POST['pass'])){
			
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$login_data = $this->model->get($user);
			var_dump(login_data);
			
			if ($login_data && password_verify($pass,$login_data->pass)){
				$this->create_session($login_data);
			}else{
				$this->login_error();
			}
		} else {
			
			$this->login_error();
			
		}
			
			
	}
	
	function logout(){
		
		session_start();
		session_destroy();
		header("Refresh:0");
		
	}
	
	function create_session($data){
		
		session_start();
		$_SESSION['user'] = $data->user;
		$_SESSION['permissions'] = $data->role;
		var_dump($_SESSION);
		header(BASE_URL . '/admin');
		
	}
	
	function login_error(){
		
		$this->view->init(true);
		
	}
	
	function alta_user(){
		
		$this->view->alta_user();
		
	}
	
	function send_form(){
		
		if (isset($_POST['user']) && isset($_POST['user']) && isset($_POST['user'])){
			$user = $_POST['user'];
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			$email = $_POST['email'];
			$role = "user";
			
			$query = $this->model->alta($user,$pass,$email,$role);
			($query) ? $this->view->success() : $this->view->fail();
		} else{
			$this->view->fail();
		
		}
	}
	
}