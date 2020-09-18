<?php

echo "<form method='post' action='admin/personas/update/$persona->id'>
		<input type='text' name='nombre' placeholder='nombre'></input>
		<input type='text' name='periodo' placeholder='periodo'></input>
		<input type='text' name='descripcion' placeholder='descripcion'></input>
		<input type='text' name='foto' placeholder='foto'></input>
		<input type='checkbox' name='presidente'";
echo ($persona->presidente) ? "checked" : "";
echo" ></input>
		<button type='submit'>Enviar</button>
	</form>";