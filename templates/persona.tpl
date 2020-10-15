<section class="emergente"> 
		{if $persona->presidente} 
			<h2 class="nombre">Presidente del Bloque: {$persona->nombre}</h2>
		{else} 
			<h2 class="nombre">{$persona->nombre}</h2>
		{/if}
		
		<img class="img-persona" src="includes/img/{$persona->foto}" alt="{$persona->nombre}"/>
		
		{if $persona->descripcion}
			<p class="desc">{$persona->descripcion}</p>
		{else}
			<p class="desc">Descripción no disponible.</p>
		{/if}
		
		<div class="relaciones">
			<h2> <a href=comisiones>Comisiones:</a> </h2>
			<p> {foreach from=$persona->comisiones item=comision} <a href=comisiones/{$comision->nombre}>{$comision->nombre}</a>,{/foreach} </p>
		</div>
</section>