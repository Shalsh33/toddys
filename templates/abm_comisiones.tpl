{include file="templates/header.tpl"}
<a href="admin/comisiones" id="back"><img src="includes/img/back.png" alt="back"></a>
<article>
	<h1 class="tituloPpal"> Administrador comisiones => </h1> 

	<h2>Nombre: {$comision->nombre}<h2>
	<h2>Fecha: {$comision->fecha_de_reunion}<h2>
	
</article>
<article class="h-100">
	
		<form method="post" id="edit">
			<input type='text' name='nombre' placeholder='nombre' value="{$comision->nombre}"></input>
			<input type='text' name='fecha' placeholder='fecha de reunion' value="{$comision->fecha_de_reunion}"></input>
			<p>Personas: </p>
			{foreach from=$personas item=persona}
				<input type='checkbox' name='personas[]' value={$persona->id} {if $persona->selected}checked{/if}>{$persona->nombre}</input>
			{/foreach}
			<button type='submit' class="btn btn-dark">Enviar</button>
		</form>
		
	
	<section class="mt-5">
		<h1>Eliminar comisión</h1>
		<form id="delete" class="mx-auto w-50">
			
			<p class="text-dark">Está usted seguro de querer eliminar la comisión? (Esta acción no se puede deshacer)</p>
			<button type='submit' class="btn btn-dark">Eliminar</button>
			
		</form>
	</section>
		
	
		
</article>
<script type="text/javascript" src="includes/js/abm_comisiones.js"></script>
