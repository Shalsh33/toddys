{include file="header.tpl"}

<article id="contenido">
	<h1> Administrador comisiones => {$action}</h1>
	 
	{if $action eq "agregar"} 

		<form method="post">
			<input type='text' name='nombre' placeholder='nombre'></input>
			<input type='text' name='fecha' placeholder='fecha de reunion'></input>
			<button type='submit' id="send">Enviar</button>
		</form>

	{else}

		<h2><span>{$comision->id}</span>_{$comision->nombre}<h2>
		<h2>{$comision->fecha_de_reunion}<h2>
		
		{if $action eq "editar"}
		
			<form method="post">
				<input type='text' name ='id' id='id' value="{$comision->id}" readonly></input>
				<input type='text' name='nombre' placeholder='nombre' value="{$comision->nombre}"></input>
				<input type='text' name='fecha' placeholder='fecha de reunion' value="{$comision->fecha_de_reunion}"></input>
				<p>Personas: </p>
				{foreach from=$personas item=persona}
					<input type='checkbox' name='personas[]' value={$persona->id} {if $persona->checked}checked{/if}>{$persona->nombre}</input>
				{/foreach}
				<button type='submit' id="update_{$comision->id}">Enviar</button>
			</form>
			
		{else}
		
			<h1>¿Está usted seguro de querer eliminar la comision y todas sus participantes? (Esta acción no se puede deshacer)</h1>
			<form method="post">
				<input type='text' name ='id' id='id' value="{$comision->id}" readonly></input>
				<button type='submit' id="elim_{$comision->id}">Eliminar</button>
			</form>
			
		{/if}
		
	{/if}
</article>
<script type="text/javascript" src="includes/js/abm_comisiones.js"></script>
{include file="footer.tpl"}