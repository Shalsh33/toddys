<?php
	
require_once "app/model/model.personas.php";
require_once "app/model/model.comisiones.php";
require_once "app/controller/controller.php";
require_once "app/view/index.view.php";
	
class index_controller extends controller{
	
	protected $view;
	protected $model_personas;
	protected $model_comisiones;
	
	function __construct(){
		
		$sesion = $this->sesion();
		$this->view = ($sesion) ? new index_view($sesion,$this->username()) : new index_view($sesion);
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		if(!$this->model_personas->check_connection() || !$this->model_comisiones->check_connection()){
			$this->view->connection_error();
		}
		
	}
	
	function inicio(){
		
		$this->view->inicio();
		
	}
	
	function personas($params = null){
			
			if (!($params)){
				$datos = $this->model_personas->get_all_extended();
				$this->view->personas($datos);
			} else {
				
				$this->persona($params[':id']);
				
			}
		
			
			
	}
	
	function persona($id){
		
		$persona = $this->model_personas->get_one_extended($id);
		
		$this->view->persona($persona);
		
	}
	
	function comisiones($params){
		
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$datos = $this->model_comisiones->get_all_extended($page);
		
		$last = ($datos) ? false : true;
		$this->view->comisiones($datos,$page,$last);
		
	}
	
	/*function comision($id){
		
		$comision = $this->model_comisiones->get_one($id);
		
		$this->view->comision($comision);
		
	}*/
	
}