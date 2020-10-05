<?php

require_once 'app/view/view.php';

class index_view extends view{

	function index(){
		
		$this->templateEngine->display("templates/header.tpl");
		
	}
	
	function personas($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/personas.tpl");
		
	}
	
	function comisiones($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/comisiones.tpl");
		
	}
	
	function comision($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/comision.tpl");
		
	}
	
	function connection_error(){
		
		$this->templateEngine->display("templates/connection_error.tpl");
		
	}
	
}