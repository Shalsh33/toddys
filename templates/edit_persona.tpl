{include file='header.tpl'}

<h1> Administrador personas => Editar: {$persona->nombre} </h1> 
<h2>{$persona->nombre}<h2>
<h2>{$persona->periodo}<h2>
<h2>{$persona->descripcion}<h2>
<h2>{$persona->foto}<h2>

{if $persona->presidente}
	<h2>Es presidente</h2>
{else}
	<h2> No es presidente </h2>
{/if}

<form id="update">

	<input type='text' name='nombre' placeholder='nombre'></input>
	<input type='text' name='periodo' placeholder='periodo'></input>
	<input type='text' name='descripcion' placeholder='descripcion'></input>
	<input type='text' name='foto' placeholder='foto'></input>
	<input type='checkbox' name='presidente'></input>
	<button type='button'>Enviar</button>
	
</form>

{include file='footer.tpl'}