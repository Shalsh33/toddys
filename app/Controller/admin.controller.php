<?php

require_once "app/Model/admin.model.concejales.php";
require_once "app/View/admin.view.php";

class admin_controller{

	protected $model_concejales;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	function __construct(){
		$this->model_concejales = new admin_model_concejales();
		//$this->model_comisiones = new admin_model_concejales();
		//$this->model_relaciones = new admin_model_concejales();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->main_page();
	}
	
	function listar_concejales(){
		$array_db = $this->model_concejales->obtener_concejales();
		
		$this->view->administrar_concejales($array_db);
	}
}