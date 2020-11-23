<?php
	
require_once "app/controller/controller.php";
require_once "app/model/model.users.php";
require_once "app/view/auth.view.php";
	
class auth_controller extends controller {
	
	protected $view;
	protected $model;
	
	function __construct(){
		
		$this->view = new auth_view(false);
		$this->model = new model_users();
		session_start();
		
	}
	
	function check_session(){
		
		if ( ($this->sesion()) && (isset($_SESSION['user'])) ){
			header('location: ' . BASE_URL . 'admin');
			die();
		}
		
	}
	
	function init(){
		
		$this->check_session();
		$this->view->init();
		
	}
	
	function login(){
		
		
		$this->check_session();
		
		if (isset($_POST['user']) && isset($_POST['pass'])){
			
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$login_data = $this->model->get($user);
			
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
		
		$_SESSION = array();
		session_destroy();
		
	}
	
	private function create_session($data){
		
		header("refresh: 3; url =".BASE_URL."admin");
		$_SESSION['user'] = $data->user;
		$_SESSION['permissions'] = $data->role;
		
		
	}
	
	function login_error(){
		
		$this->check_session();
		$this->view->init(true);
		
	}
	
	function alta_user(){
		
		$this->check_session();
		$this->view->alta_user();
		
	}
	
	function send_form(){
		
		if (isset($_POST['user']) && isset($_POST['password']) && !empty($_POST['user']) && !empty($_POST['password'])){
			$user = $_POST['user'];
			$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$email = $_POST['email'];
			$role = "user";
			
			$query = $this->model->add($user,$pass,$email,$role);
			if ($query) {
				$this->view->success();
				$sesion = (object) ["user" => $user, "role" => "user"];
				$this->create_session($sesion);
			}else{
				$this->view->fail();
				header('refresh:3;url='.BASE_URL.'login');
			}
			
		} else{
			$this->view->fail();
			header('refresh:2;url='.BASE_URL.'registro');
		}
	}
	
}