{include file="templates/header.tpl"}

<article>
	<h1 class="tituloPpal"> Administrador personas</h1>

	<h2>Nombre: {$persona->nombre}<h2>
	<h2>Periodo: {$persona->periodo}<h2>
	<h2>Descripción: {$persona->descripcion}<h2>
	<h2>Foto: {$persona->foto}<h2>
	
	{if $persona->presidente}
		<h2>Es presidente</h2>
	{else}
		<h2> No es presidente </h2>
	{/if}
</article>
<article>
	
	<form id="edit">
			<input type='text' name='nombre' placeholder='nombre' value="{$persona->nombre}"></input>
			<input type='text' name='periodo' placeholder='periodo' value="{$persona->periodo}"></input>
			<input type='text' name='descripcion' placeholder='descripcion' value="{$persona->descripcion}"></input>
			<input type='text' name='foto' placeholder='foto' value="{$persona->foto}"></input>
			<input type='checkbox' name='presidente' {if $persona->presidente} checked {/if}>Presidente</input>
			<p>Comisiones: </p>
			{foreach from=$comisiones item=comision}
				<input type='checkbox' name='comisiones[]' value={$comision->id} {if $comision->selected}checked{/if}>{$comision->nombre}</input>
			{/foreach}
			<button type='submit'>Enviar</button>
	</form>
		
		
		<h1>Está usted seguro de querer eliminar la persona y todas sus participaciones en comisiones? (Esta acción no se puede deshacer)</h1>
		<form id="delete">
			<button type='submit'>Eliminar</button>
		</form>
		
</article>
<script type="text/javascript" src="includes/js/edit_personas.js"></script>
