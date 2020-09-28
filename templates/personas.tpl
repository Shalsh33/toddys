{foreach from=$datos item=persona}
	{if $persona->presidente} 
		<section class="presidente"> 
	{else} 
		<section class="concejal"> 
	{/if}
	<img class="img-persona" src="includes/img/{$persona->foto}" alt="{$persona->nombre}"/>
	<h2 class="nombre">{$persona->nombre}</h2>
	<p>{$persona->descripcion}</p>
	<h2> <a href=comisiones>Comisiones:</a> </h2>
	<p> {foreach from=$persona->comisiones item=comision} <a href=comisiones/{$comision->nombre}>{$comision->nombre}</a>,{/foreach} </p>
	</section>
{/foreach}
