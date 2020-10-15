

<article id="contenido">

	<h1 class="tituloPpal">Miembros del Bloque</h1>
	
	{foreach from=$datos item=persona}
		{if $persona->presidente} 
			<section class="presidente" id="{$persona->id}"> 
			<h2 class="nombre">Presidente del Bloque: {$persona->nombre}</h2>
		{else} 
			<section class="persona" id="{$persona->id}"	> 
			<h2 class="nombre">{$persona->nombre}</h2>
		{/if}
		<img class="img-persona" src="includes/img/{$persona->foto}" alt="{$persona->nombre}"/>
		<div class="relaciones">
			<h2> <a href=comisiones>Comisiones:</a> </h2>
			<p> {foreach from=$persona->comisiones item=comision} {$comision->nombre},{/foreach} </p>
		</div>
		</section>
	{/foreach}

</article>
<script type="text/javascript" src="includes/js/persona.js"></script>
