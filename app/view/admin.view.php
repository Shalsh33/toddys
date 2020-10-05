<?php

require_once 'app/view/view.php';

class admin_view extends view{
	
	function main_page(){
		$this->templateEngine->display("templates/admin_main.tpl");
	}
	
	function admin_personas($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_personas.tpl");
		
	}
	
	function edit($persona){
	
		$this->templateEngine->assign("persona",$persona);
		$this->templateEngine->assign("action","editar");
		$this->templateEngine->display("templates/abm_personas.tpl");
	
	}
	
	function form_alta(){
		
		$this->templateEngine->assign("action","agregar");
		$this->templateEngine->display("templates/abm_personas.tpl");
		
	}
	
	function confirm_delete($persona){
		
		$this->templateEngine->assign("persona",$persona);
		$this->templateEngine->assign("action","borrar");
		$this->templateEngine->display("templates/abm_personas.tpl");
		
	}
	
	function action_done(){
		
		echo '<h1>Cambio realizado con èxito. Redireccionando a admin page</h1>';
		
	}
	
	
	function error_param(){
		
		echo '<h1>Parámetro mal especificado. Redireccionando a admin page</h1>';
		
	}
	
	function connection_error(){
		
		echo '<h1>Db connection error. Redirecting to admin page</h1>';
	}
}