{include file="templates/header.tpl"}
<article id="contenido">
<h1 class="tituloPpal"> Administrador DB comisiones </h1>

<div>
<h2> Agregar comisión </h2>

<form method="post">
	<input type='text' name='nombre' placeholder='nombre'></input>
	<input type='text' name='fecha' placeholder='fecha de reunion'></input>
	<button type='submit' id="send">Agregar</button>
</form>
</div>


{foreach from=$datos item=comision}
	<div class="comision"> 
		<h2>{$comision->nombre}<h2>
		<a href='admin/comisiones/{$comision->id}'>Editar</a>
	</div>
{/foreach}

</article>

<script type="text/javascript" src="includes/js/add.js"></script>
