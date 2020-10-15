<article id="contenido">
	<section id="emergente">
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
		
	</section>
</article>