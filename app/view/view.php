<?php

require_once 'libs/Smarty.class.php';

class view{
	
	protected $templateEngine;
	
	function __construct(){
	
		$this->templateEngine = new Smarty();
		
	}
	
}