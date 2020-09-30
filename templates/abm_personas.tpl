{include file="header.php"}

<article id="contenido">
	<h1> Administrador personas => {$action}</h1>
	 
	{if $action eq "agregar"} 

		<form>
			<input type='text' name='nombre' placeholder='nombre'></input>
			<input type='text' name='periodo' placeholder='periodo'></input>
			<input type='text' name='descripcion' placeholder='descripcion'></input>
			<input type='text' name='foto' placeholder='foto'></input>
			<input type='checkbox' name='presidente'></input>
			<button type='button' id="add">Enviar</button>
		</form>

	{else}

		<h2><span>{$persona->id}</span>_{$persona->nombre}<h2>
		<h2>{$persona->periodo}<h2>
		<h2>{$persona->descripcion}<h2>
		<h2>{$persona->foto}<h2>

		{if $persona->presidente}
			<h2>Es presidente</h2>
		{else}
			<h2> No es presidente </h2>
		{/if}
		
		{if $action eq "editar"}
		
			<form>
				<input type='text' name='nombre' placeholder='nombre'></input>
				<input type='text' name='periodo' placeholder='periodo'></input>
				<input type='text' name='descripcion' placeholder='descripcion'></input>
				<input type='text' name='foto' placeholder='foto'></input>
				<input type='checkbox' name='presidente'></input>
				<button type='button' id="update_{$persona->id}">Enviar</button>
			</form>
			
		{else}
		
			<h1>Está usted seguro de querer eliminar la persona y todas sus participaciones en comisiones? (Esta acción no se puede deshacer)</h1>
			<button type='button' id="delete_{$persona->id}">Eliminar</button>
			
		{/if}
		
	{/if}
</article>

{include file="footer.php"}