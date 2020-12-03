{include file="templates/header.tpl"}
<article id="contenido">
<h1 class="tituloPpal">Comisiones HCD Tres Arroyos</h1>
{foreach from=$datos item=comision}
	<section class="comision"> 
	<h2 class="nombre">{$comision->nombre}</h2>
	<p>{$comision->fecha_de_reunion}</p>
	<h2> <a href=inicio>Miembros:</a> </h2>
	<p> {foreach from=$comision->personas item=persona} <a href="personas?{$persona->normalizedName}">{$persona->nombre}</a>,{/foreach} </p>
	</section>
{/foreach}

</article>
<div class="d-flex justify-content-center">
{if $page>1}
	<a href="comisiones?page={$page-1}"><button class="btn btn-dark">Página anterior</button></a>
{/if}
{if not $last}
	<a href="comisiones?page={$page+1}"><button class="btn btn-dark">Página siguiente</button></a>
{/if}
</div>