<?php

class admin_view{
	
	function main_page(){
		include 'templates/header.php';
		//include 'templates/interfaz.admin.php';
		//include 'templates/footer.php';
		echo "<a class='btn btn-danger btn-sm' href='?action=admin/concejales'>Ver DB personas</a>";
	}
	
	function administrar_concejales($datos){
		include 'templates/header.php';
		echo "<h1> Administrador DB concejales </h1>";
		echo"<ul>";
		foreach($datos as $concejal){
				echo "
				<li> 
					<h2>$concejal[nombre]<h2>
					<a class='btn btn-danger btn-sm' href='?action=admin/concejales/editar/$concejal[id_concejal]'>Editar</a>
				</li>";
		}
		echo "</ul>";
		
		
		//include 'templates/footer.php';
	}
}