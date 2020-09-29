<?php

require_once 'app/view/view.php';

class index_view extends view{
	
	function init(){
		
		$this->templateEngine->display("templates/header.tpl");
		
	}
	
	function main_page($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/personas.tpl");
		
	}
	
	function comisiones_page($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/comisiones.tpl");
		
	}
	
}