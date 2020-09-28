{foreach from=$datos item=persona}
	{if $persona->presidente} 
		<section class="presidente"> 
	{else} 
		<section class="concejal"> 
	{/if}
	<img class="img-persona" src="includes/img/{$persona->foto}" alt="{$persona->nombre}"/>
	<h2 class="nombre">{$persona->nombre}</h2>
	<p>{$persona->descripcion}</p>
{/foreach}