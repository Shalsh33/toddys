<?php
	
require_once "app/model/model.personas.php";
//require_once "app/model/model.relaciones.php";
require_once "app/view/index.view.php";
	
class index_controller {
	
	protected $view;
	protected $model_personas;
	protected $model_relaciones;
	
	function __construct(){
		
		$this->view = new index_view();
		$this->model_personas = new model_personas();
		//$this->model_relaciones = new model_relaciones();
		
	}
	
	function init(){
		
		$datos = $this->model_personas->obtener_personas();
		
		$this->view->main_page($datos);
			
	}
	
}