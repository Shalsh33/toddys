<script type="module" src="includes/js/check.js"></script><!--
<article id="abm">
	<h1> Administrador personas => {$action}</h1>
	 
	{if $action eq "agregar"} 

		<form>
			<input type='text' name='nombre' placeholder='nombre'></input>
			<input type='text' name='periodo' placeholder='periodo'></input>
			<input type='text' name='descripcion' placeholder='descripcion'></input>
			<input type='text' name='foto' placeholder='foto'></input>
			<input type='checkbox' name='presidente'></input>
			<button type='submit' id="send">Enviar</button>
		</form>

	{else}

		<h2><span>{$persona->id}</span>_{$persona->nombre}</h2>
		<h2>{$persona->periodo}</h2>
		<h2>{$persona->descripcion}</h2>
		<h2>{$persona->foto}</h2>

		{if $persona->presidente}
			<h2>Es presidente</h2>
		{else}
			<h2> No es presidente </h2>
		{/if}
		
		{if $action eq "editar"}
		
			<form method="post">
				<input type='text' name ='id' id='id' value="{$persona->id}" readonly></input>
				<input type='text' name='nombre' placeholder='nombre' value="{$persona->nombre}"></input>
				<input type='text' name='periodo' placeholder='periodo' value="{$persona->periodo}"></input>
				<input type='text' name='descripcion' placeholder='descripcion' value="{$persona->descripcion}"></input>
				<input type='text' name='foto' placeholder='foto' value="{$persona->foto}"></input>
				<input type='checkbox' name='presidente' {if $persona->presidente} checked {/if}></input>
				<button type='submit' id="update_{$persona->id}">Enviar</button>
			</form>
			
		{else}
		
			<h1>Está usted seguro de querer eliminar la persona y todas sus participaciones en comisiones? (Esta acción no se puede deshacer)</h1>
			<form>
				<input type='text' name ='id' id='id' value="{$persona->id}-{$persona->nombre} readonly></input>
				<button type='submit' id="elim_{$persona->id}">Eliminar</button>
			</form>
			
		{/if}
		
	{/if}
</article>

<script type="text/javascript" src="includes/js/abm_personas.js"></script>