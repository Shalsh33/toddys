<?php

class controller{
	
	protected function sesion(){
		
		/*$status = session_status();
		
		return ($status == PHP_SESSION_ACTIVE) ? true : false;*/
		if (!isset($_SESSION)){
			session_start();
		}
		
		return (isset($_SESSION['user'])) ? true : false;
		
	}
	
	protected function username(){
		
		return ($_SESSION['user']);
		
	}
	
	
	
}