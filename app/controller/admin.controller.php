<?php

require_once "app/Model/admin.model.personas.php";
require_once "app/View/admin.view.php";

class admin_controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	function __construct(){
		$this->model_personas = new admin_model_personas();
		//$this->model_comisiones = new admin_model_comisiones();
		//$this->model_relaciones = new admin_model_relaciones();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->main_page();
	}
	
	function listar_personas(){
		$array_db = $this->model_personas->obtener_personas();
		
		$this->view->administrar_personas($array_db);
	}
	
	function editar_persona($id){
		$info = $this->model_personas->obtener_uno($id);
		
		$this->view->edicion($info);
	}
	
	function enviar_edit($id) {
		
		if (isset($_POST['presidente'])){
			$result = $this->model_personas->editar_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], true, $_POST['foto']);
		} else {
			$result = $this->model_personas->editar_persona($id, $_POST['nombre'], $_POST['periodo'], $_POST['descripcion'], false, $_POST['foto']);
		}
		
		$this->listar_personas();
	}

	
}