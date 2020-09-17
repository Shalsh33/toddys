<?php

require_once "app/Model/admin.model.php";
require_once "app/View/admin.view.php";

class admin_controller(){

	protected $model_concejales;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	protected function __construct(){
		$this->model_concejales = new admin_model_concejales();
		$this->model_comisiones = new admin_model_concejales();
		$this->model_relaciones = new admin_model_concejales();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->mainPage();
	}
	
	function listar_concejales(){
		$array_db = $this->model_concejales->obtener_concejales();
		
		$this->view->lista("concejales",$array_db);
	}