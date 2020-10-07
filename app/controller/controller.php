<?php

class controller{
	
	protected function sesion(){
		
		session_start();
		
		return ($_SESSION) ? true : false;
		
	}
	
	protected function username(){
		
		session_start();
		
		return ($_SESSION['user']);
		
	}
	
	
	
}