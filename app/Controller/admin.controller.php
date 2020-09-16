<?php

require_once "app/model/admin.model.php";
require_once "app/view/admin.view.php";

class admin_controller(){

	protected $model;
	protected $view;

	protected function __construct(){
		$this->model = new admin_model();
		$this->view = new admin_view();
	}
	
	function init(){
		$this->view->mainPage();