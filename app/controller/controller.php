<?php

class controller{
	
	protected function sesion(){
		
		if (!isset($_SESSION)){
			session_start();
		}
		
		return (isset($_SESSION['user'])) ? true : false;
		
	}
	
	protected function username(){
		
		return ($_SESSION['user']);
		
	}
	
	
	
}