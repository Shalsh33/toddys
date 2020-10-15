<?php

require_once 'libs/Smarty.class.php';

class view{
	
	protected $templateEngine;
	
	function __construct($sesion, $user = "invitado"){
	
		$this->templateEngine = new Smarty();
		$this->templateEngine->assign("sesion",$sesion);
		$this->templateEngine->assign("user",$user);
		$this->templateEngine->display("templates/header.tpl");
		
	}
	
}