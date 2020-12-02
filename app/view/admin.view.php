<?php

require_once 'app/view/view.php';

class admin_view extends view{
	
/* Pagina principal */
	function main_page($level){
		$this->templateEngine->assign("level",$level);
		$this->templateEngine->display("templates/admin_main.tpl");
	}
//Avisos
	function action_done($flags = null){
		
		if (! $flags){
			echo '<h1>Cambio realizado con éxito.';
		} else {
			echo '<h1> Ha ocurrido un problema en la subida de archivos ->';
			if (isset($flags['upload'])){
				echo 'El archivo no pudo ser subido.';
			}
			if (isset($flags['type'])){
				echo 'El archivo no es una imagen.';
			}
			if (isset($flags['none'])){
				echo 'No hay archivos para subir.';
			}
			echo '</h1>';
		}
	
	}
	
	function error_param(){
		
		echo '<h1>Parámetro mal especificado.</h1>';
		
	}
	
	function connection_error(){
		
		echo '<h1>Db connection error. Redirecting to admin page</h1>';

	}
	
	function denied(){
		
		echo'<h1>Buen intento, pero no podés estar acá <a href="'.BASE_URL.'admin">Volvé</a></h1>';
		
	}
	
/* Personas */
	function admin_personas($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_personas.tpl");
		
	}
	
	function edit_persona($persona,$comisiones){
	
		$this->templateEngine->assign("persona",$persona);
		$this->templateEngine->assign("comisiones",$comisiones);
		$this->templateEngine->display("templates/abm_personas.tpl");
	
	}
	
/* Comisiones */
	function admin_comisiones($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_comisiones.tpl");
		
	}
	
	function edit_comision($comision,$personas){
	
		$this->templateEngine->assign("comision",$comision);
		$this->templateEngine->assign("personas",$personas);
		$this->templateEngine->display("templates/abm_comisiones.tpl");
	
	}
	
/*Users*/
	function admin_users($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_users.tpl");
		
	}
	
	function edit_user($user){
		
		$this->templateEngine->assign("usuario",$user);
		$this->templateEngine->display("templates/edit_users.tpl");
		
	}
	
}