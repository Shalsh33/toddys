<?php

require_once "app/Model/model.personas.php";
require_once "app/Model/model.comisiones.php";
require_once "app/View/admin.view.php";

class admin_controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	function __construct(){
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		$this->model_relaciones = new model_relaciones();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->main_page();
	}
	
	function list_personas(){
		
		if ($this->model_personas->check_connection()){
			$array_db = $this->model_personas->get_all();
			$this->view->admin_personas($array_db);
		} else {
			$this->view->connection_error();
		}
	}
	
	function edit_persona($id){
		
		($id) ? $info = $this->model_personas->get_one($id) : $info = null;
		
		($info) ? $this->view->edit($info) : $this->view->error_param();
	}
	
	function send_edit_persona() {
		
		$id = $_POST['id'];
		$persona = array(
		"nombre" => $_POST['nombre'],
		"periodo" => $_POST['periodo'],
		"descripcion" => $_POST['descripcion'],
		"presidente" => isset($_POST['presidente']),
		"foto" => $_POST['foto']
		);
		
		$update = $this->model_personas->edit_persona($id,$persona);
		
		($update) ? $this->view->action_done() : $this->view->error_param();
		
	}
	
	function add_persona(){
		
		$this->view->form_alta();
		
	}
	
	function send_form_persona(){
		
		if (isset($_POST['nombre']) && isset($_POST['periodo'])){
			$nombre = $_POST['nombre'];
			$periodo = $_POST['periodo'];
		} else {
			$this->view->error_param();
			die;
		}
			
		$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : null;
		$presidente = (isset($_POST['presidente']));
		$foto = (isset($_POST['foto'])) ? $_POST['foto'] : null;
		
		$this->model_personas->insert_persona($nombre,$periodo,$descripcion,$presidente,$foto); 
		$this->view->change_ready();
		
	}
	
	function delete_persona($id){
		
		$persona = $this->model_personas->get_one($id);
		
		$this->view->confirm_delete($persona);
		
	}
	
	function confirm_delete(){
		
		$result = ($_POST['id']) ? $this->model_personas->delete_persona($_POST['id']) : null;
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
		header("Location:admin/personas");
		
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