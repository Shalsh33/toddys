<?php

require_once "app/Model/model.personas.php";
require_once "app/View/admin.view.php";

class admin_controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	function __construct(){
		$this->model_personas = new model_personas();
		//$this->model_comisiones = new admin_model_comisiones();
		//$this->model_relaciones = new admin_model_relaciones();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->main_page();
	}
	
	function list_personas(){
		$array_db = $this->model_personas->get_personas();
		
		$this->view->admin_personas($array_db);
	}
	
	function edit_persona($id){
		
		($id) ? $info = $this->model_personas->get_one($id) : $info = null;
		
		($info) ? $this->view->edit($info) : $this -> error_id();
	}
	
	function send_edit($id) {
		
		(isset($_POST['presidente']) ? $result = $this->model_personas->edit_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], true, $_POST['foto']); 
									 : $result = $this->model_personas->edit_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], false, $_POST['foto']);
		
		$this->list_personas();
	}
	
	function error_id(){
		
		
		
	}

	
}