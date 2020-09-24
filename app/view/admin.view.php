<?php

class admin_view{
	
	function main_page(){
		include 'templates/header.php';
		include 'templates/nav.php';
		//include 'templates/interfaz.admin.php';
		echo "<a class='btn btn-danger btn-sm' href='admin/personas'>Ver DB personas</a>";
		echo "<br><a class='btn btn-danger btn-sm' href='admin/relaciones'>Asignar personas a comisiones</a>";
		echo "<br><a class='btn btn-danger btn-sm' href='admin/users'>Ver DB usuarios</a>";
		echo "<br><a class='btn btn-danger btn-sm' href='admin/comisiones'>Ver DB comisiones</a>";
		echo "<br>";
		include 'templates/footer.php';
	}
	
	function admin_personas($datos){
		include 'templates/header.php';
		include 'templates/nav.php';
		echo "<h1> Administrador DB personas </h1>";
		echo"<ul>";
		foreach($datos as $persona){
				echo "
				<li> 
					<h2>$persona->nombre<h2>
					<a class='btn btn-danger btn-sm' href='admin/personas/editar/$persona->id'>Editar</a>
				</li>";
		}
		echo "</ul>";
		
		
		include 'templates/footer.php';
	}
	
	function edit($persona){
		include 'templates/header.php';
		include 'templates/nav.php';
		echo "
		<h1> Administrador personas => Editar: $persona->nombre </h1> 
		
		<h2>$persona->nombre<h2>
		<h2>$persona->periodo<h2>
		<h2>$persona->descripcion<h2>
		<h2>$persona->foto<h2>";
		echo ($persona->presidente) ? ("<h2>Es presidente</h2>") : ("<h2> No es presidente </h2>");
		
		include 'templates/form.edit.personas.php';
		include 'templates/footer.php';
	}
	
	function connection_error(){
		
		include 'templates/header.php';
		include 'templates/nav.php';
		
	}
}