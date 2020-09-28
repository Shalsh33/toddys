<?php

require_once 'app/view/view.php';

class index_view extends view{
	
	function main_page($datos){
		include 'templates/index.php';
	}
	
}