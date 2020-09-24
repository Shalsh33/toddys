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
		$this->model_comisiones = new admin_model_comisiones();
		//$this->model_relaciones = new admin_model_relaciones();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->main_page();
	}
	
	function list_personas(){
		
		if ($this->model_personas->check_connection()){
			$array_db = $this->model_personas->get_personas();
			$this->view->admin_personas($array_db);
		} else {
			$this->view->connection_error();
		}
	}
	
	function edit_persona($id){
		
		($id) ? $info = $this->model_personas->get_one($id) : $info = null;
		
		($info) ? $this->view->edit($info) : $this->view->error_param();
	}
	
	function send_edit_persona($id) {
		
		(isset($_POST['presidente']) ? $result = $this->model_personas->edit_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], true, $_POST['foto']); 
									 : $result = $this->model_personas->edit_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], false, $_POST['foto']);
		
		header("Location:admin/personas");
		//$this->list_personas();
	}
	
	function add_persona(){
		
		$this->view->form_alta();
		
	}
	
	function send_form_persona(){
		
		$nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : $this->view->error_param();
		$periodo = (isset($_POST['periodo']) ? $_POST['periodo'] :$this->view->error_param();
		$descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
		$presidente = (isset($_POST['presidente']) ? true : false;
		$foto = (isset($_POST['foto']) ? $_POST['foto'] : null;
		
		$this->model_personas->insert_persona($nombre,$periodo,$descripcion,$presidente,$foto); 
		
	}

	function list_comisiones(){
		
		if ($this->model_comisiones->check_connection()){
			$array_db = $this->model_comisiones->get_personas();
			$this->view->admin_comisiones($array_db);
		} else {
			$this->view->connection_error();
		}
		
	}
}