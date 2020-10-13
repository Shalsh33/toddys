<?php

require_once 'app/view/view.php';

class admin_view extends view{
	
	/* Generales */
	function main_page(){
		$this->templateEngine->display("templates/admin_main.tpl");
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
	
	/* Personas */
	function admin_personas($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_personas.tpl");
		
	}
	
	function edit_persona($persona){
	
		$this->templateEngine->assign("persona",$persona);
		$this->templateEngine->assign("action","editar");
		$this->templateEngine->display("templates/abm_personas.tpl");
	
	}
	
	function form_alta_persona(){
		
		$this->templateEngine->assign("action","agregar");
		$this->templateEngine->display("templates/abm_personas.tpl");
		
	}
	
	function confirm_delete($persona){
		
		$this->templateEngine->assign("persona",$persona);
		$this->templateEngine->assign("action","borrar");
		$this->templateEngine->display("templates/abm_personas.tpl");
		
	}
	
	/* Comisiones */
	function admin_comisiones($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_comisiones.tpl");
		
	}
	
	function edit_comision($comision){
	
		$this->templateEngine->assign("comision",$comision);
		$this->templateEngine->assign("action","editar");
		$this->templateEngine->display("templates/abm_comisiones.tpl");
	
	}
	
	function form_alta_comision(){
		
		$this->templateEngine->assign("action","agregar");
		$this->templateEngine->display("templates/abm_comisiones.tpl");
		
	}
	
	function confirm_delete_comision($comision){
		
		$this->templateEngine->assign("comision",$comision);
		$this->templateEngine->assign("action","borrar");
		$this->templateEngine->display("templates/abm_comisiones.tpl");
		
	}
	
	/*Relaciones*/
	
}