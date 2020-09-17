<?php

require_once "app/Model/admin.model.php";
require_once "app/View/admin.view.php";

class admin_controller(){

	protected $model;
	protected $view;

	protected function __construct(){
		$this->model = new admin_model();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->mainPage();