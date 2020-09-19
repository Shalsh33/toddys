<?php
	
	echo "<article id='main'>";
	foreach($datos as $persona){
		echo ($persona->presidente) ? "<section class='presidente'>" : "<section class='concejal'>";
		echo "<img src='/includes/img/$persona->foto' alt='$persona->nombre'/>
				<h2 class='nombre'>$persona->nombre</h2>
				<p>$persona->descripcion</p>";
	}
	echo "</article>";