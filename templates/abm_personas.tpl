{include file="templates/header.tpl"}
<script type="text/javascript" src="includes/js/edit_personas.js"></script>
<article>
	<h1 class="tituloPpal"> Administrador personas</h1>

	<h2>Nombre: {$persona->nombre}<h2>
	<h2>Periodo: {$persona->periodo}<h2>
	<h2>Descripción: {$persona->descripcion}<h2>
	
	{if $persona->presidente}
		<h2>Es presidente</h2>
	{else}
		<h2> No es presidente </h2>
	{/if}
</article>
<article class="h-100">
	
	<form enctype="multipart/form-data" id="edit">
			<input type='text' name='nombre' placeholder='nombre' value="{$persona->nombre}"></input>
			<input type='text' name='periodo' placeholder='periodo' value="{$persona->periodo}"></input>
			<input type='text' name='descripcion' placeholder='descripcion' value="{$persona->descripcion}"></input>
			<input type='file' name='foto[]' placeholder='foto' id="foto" multiple></input>
			<input type='checkbox' name='presidente' {if $persona->presidente} checked {/if}> Presidente</input>
			<p>Comisiones: </p>
			{foreach from=$comisiones item=comision}
				<input type='checkbox' name='comisiones[]' value={$comision->id} {if $comision->selected}checked{/if}>{$comision->nombre}</input>
			{/foreach}
			<button type='submit' class="btn btn-dark">Enviar</button>
	</form>
		
		
		
		
		
	<section class="mb-5">
		<div>
			<h1> Control de fotos: </h1>
		</div>
		<section class="d-flex">
			{foreach from=$persona->imagenes item=foto}
			
				<img class="col-2 wd-100" src="{$foto->nombre}" alt=" "></img>
				<div class="col-2">
					{if $foto->principal eq 0}
						<div class="mt-5">
							<button data-id="{$foto->id}" data-action="delete" class="btn btn-dark">Eliminar</button>
						</div>
						<div class="mt-5">
							<button data-id="{$foto->id}" data-action="principal" class="btn btn-dark">Convertir en portada</button>
						</div>
					{else}
						<div>
							<h1 class="align-middle"> Portada actual (Las portadas no se pueden eliminar)</h1>
						</div>
					{/if}
				</div>
			
			{/foreach}
		</section>
	</section>

	<section class="mt-5">
	<h1>Eliminar persona</h1>
		<form id="delete" class="mx-auto w-50">
			
			<p class="text-dark">Está usted seguro de querer eliminar la persona y todas sus participaciones en comisiones? (Esta acción no se puede deshacer)</p>
			<button type='submit' class="btn btn-dark">Eliminar</button>
			
		</form>
	</section>

</article>

