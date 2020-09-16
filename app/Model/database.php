<?php

class data_base_connect(){
	
	protected $db;
	
	protected function __construct($host,$dbname){
		$this->db = $this.conect($host,$dbname);
	}
	
	private function conect($host,$dbname){
		$conection = new PDO('mysql:host='.$host.';'.'dbname='.$dbname.';charset=utf8', 'root', '');
		return $conection;
	}
}