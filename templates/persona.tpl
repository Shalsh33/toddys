<script type="text/javascript" src="includes/js/redirect.js"></script>
<a href="personas" id="back"><img src="includes/img/back.png" alt="back"></a>
<section class="persona">
		{if $persona->presidente} 
			<h2 class="nombre">Presidente del Bloque: {$persona->nombre}</h2>
		{else} 
			<h2 class="nombre">{$persona->nombre}</h2>
		{/if}

		<div id="carouselExampleIndicators" class="img-persona carousel slide col-6" data-ride="carousel">
			<ol class="carousel-indicators">
			{for $i=1 to count($persona->imagenes)}
				<li data-target="#carouselExampleIndicators" data-slide-to="{$i-1}" {if $i eq 1}class="active"{/if}></li>
			{/for}
			</ol>
			<div class="carousel-inner">
				{foreach from=$persona->imagenes item=foto}
					<div class="carousel-item {if $foto->principal}active{/if}">
						<img class="d-block w-100" src="{$foto->nombre}" alt="{$persona->nombre}">
					</div>
				{/foreach}
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Anterior</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Siguiente foto</span>
			</a>
		</div>
		


		
		{if $persona->descripcion}
			<p class="desc">{$persona->descripcion}
		{else}
			<p class="desc">Descripción no disponible.
		{/if}
		Calificación: <span id="star"> </span></p>
		<div class="relaciones">
			<h2> <a href=comisiones>Comisiones:</a> </h2>
			<p> {foreach from=$persona->comisiones item=comision} {$comision->nombre},{/foreach} </p>
		</div>
		
</section>
<section class="comentarios">

	{include file="templates/vue/comments.vue"}

</section>