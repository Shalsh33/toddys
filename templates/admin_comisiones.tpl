{include file='header.tpl'}
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
		<a href='admin/comisiones/edit/{$comision->id}'>Editar</a>
		<a href='admin/comisiones/delete/{$comision->id}'>Eliminar</a>
	</div>
{/foreach}

</article>

<script type="text/javascript" src="includes/js/abm_comisiones.js"></script>
{include file='footer.tpl'}