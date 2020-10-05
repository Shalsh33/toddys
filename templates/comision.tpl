<script type="module" src="includes/js/check.js"></script><!--
<h1 class="tituloPpal">{$comision->nombre}</h1>
	<section class="comision"> 
	<p>{$comision->fecha_de_reunion}</p>
	<h2> <a href=inicio>Miembros:</a> </h2>
	<p> {foreach from=$comision->personas item=persona} {$persona->nombre},{/foreach} </p>
	</section>

