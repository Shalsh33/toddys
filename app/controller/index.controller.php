<?php
	
require_once "app/model/model.personas.php";
require_once "app/model/model.comisiones.php";

require_once "app/view/index.view.php";
	
class index_controller {
	
	protected $view;
	protected $model_personas;
	protected $model_comisiones;
	
	function __construct(){
		
		$this->view = new index_view();
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		
	}
	
	function personas(){
		
		$datos = $this->model_personas->get_personas_extended();
		
		$this->view->personas($datos);
			
	}
	
	function comisiones(){
		
		$datos = $this->model_comisiones->get_comisiones_extended();
		
		$this->view->comisiones($datos);
		
	}
	
	function comision($id){
		
		$comision = $this->model_comisiones->get_one($id);
		
		$this->view->comision($comision);
		
	}
	
}