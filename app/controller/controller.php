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
	
	protected function permissionsLevel(){

		if(!isset($_SESSION['permissions'])){
			return 0;
		}
		switch ($_SESSION['permissions']){
			case "admin": return 1;break;
			case "super admin": return 2;break;
			default: return 0;
		}

	}
	
}