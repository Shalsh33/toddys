<?php

require_once('libs/Smarty.class.php');

class admin_view{
	
	private $templateEngine;
	
	function __construct(){
	
		$this->templateEngine = new Smarty();
		
	}
	
	function main_page(){
		$this->templateEngine->display("templates/admin_main.tpl");
	}
	
	function admin_personas($datos){
		
		$this->templateEngine->assign("datos",$datos);
		$this->templateEngine->display("templates/admin_personas.tpl");
	}
	
	function edit($persona){
		include 'templates/header.php';
		include 'templates/nav.php';
		echo "
		<h1> Administrador personas => Editar: $persona->nombre </h1> 
		
		<h2>$persona->nombre<h2>
		<h2>$persona->periodo<h2>
		<h2>$persona->descripcion<h2>
		<h2>$persona->foto<h2>";
		echo ($persona->presidente) ? ("<h2>Es presidente</h2>") : ("<h2> No es presidente </h2>");
		
		include 'templates/form.personas.php';
		include 'templates/footer.php';
	}
	
	function form_alta(){
		
		include 'templates/header.php';
		include 'templates/nav.php';
		include 'templates/form.personas.php';
		include 'templates/footer.php';
		include 'templates/redirect.php';
		
	}
	
	function action_done(){
		
		include 'templates/header.php';
		include 'templates/nav.php';
		echo '<h1>Cambio realizado con èxito. Redireccionando a admin page</h1>';
		include 'templates/footer.php';
		
	}
	
	function confirm_delete(){
		include 'templates/header.php';
		include 'templates/nav.php';
		
		echo "
		<h1> Administrador personas => Borrar: $persona->nombre </h1> 
		
		<h2>$persona->nombre<h2>
		<h2>$persona->periodo<h2>
		<h2>$persona->descripcion<h2>
		<h2>$persona->foto<h2>";
		echo ($persona->presidente) ? ("<h2>Es presidente</h2>") : ("<h2> No es presidente </h2>");
		echo "<h1>Está usted seguro de querer eliminar la persona y todas sus participaciones en comisiones? (Esta acción no se puede deshacer)</h1>";
	}
	
	function error_param(){
		
		include 'templates/header.php';
		include 'templates/nav.php';
		echo '<h1>Parámetro mal especificado. Redireccionando a admin page</h1>';
		include 'templates/footer.php';
		
	}
	
	function connection_error(){
		
		include 'templates/header.php';
		include 'templates/nav.php';
		echo '<h1>Db connection error. Redirecting to admin page</h1>';
		include 'templates/footer.php';
		include 'templates/redirect.php';
	}
}