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
	
	function index(){
		
<<<<<<< HEAD
		$this->view->init();
		
	}
	
	function personas(){
		
		$datos = $this->model_personas->get_personas_extended();
=======
		$this->view->index();
>>>>>>> master
		
	}
	
	function personas(){
		if($this->model_personas->check_connection()){
			$datos = $this->model_personas->get_all_extended();
			
			$this->view->personas($datos);
		} else {
			$this->view->connection_error();
		}
			
	}
	
	function comisiones(){
		
		
			$datos = $this->model_comisiones->get_all_extended();
			
			$this->view->comisiones($datos);
		
		
		
	}
	
	function comision($nombre){
		
		$comision = $this->model_comisiones->get_one_by_name($nombre);
		
		$this->view->comision($comision);
		
	}
	
}