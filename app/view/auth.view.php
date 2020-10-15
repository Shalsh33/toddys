<?php

require_once 'app/view/view.php';

class auth_view extends view{
	
	function init($error=false){
		
		$this->templateEngine->assign('error', $error);
		$this->templateEngine->display('templates/auth.tpl');
	}
	
	function alta_user(){
		
		$this->templateEngine->assign("action","registro");
		$this->templateEngine->display('templates/abm_users.tpl');
	}
	
	function success(){
		
		echo("Registro realizado con éxito. Redirigiendo al login.");
		
	}
	
	function fail(){
		
		echo("Registro fallido, intente de nuevo más tarde.");
		
	}
	
	
}