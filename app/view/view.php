<?php

require_once 'libs/Smarty.class.php';

class view{
	
	private $templateEngine;
	
	function __construct(){
	
		$this->templateEngine = new Smarty();
		
	}
	
}