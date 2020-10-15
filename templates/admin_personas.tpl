{include file="templates/header.tpl"}
<article id="contenido">
	<h1 class="tituloPpal"> Administrador DB personas </h1>
<div>
<h2>Agregar persona</h2>
	<form method="post">
		<input type='text' name='nombre' placeholder='nombre'></input>
		<input type='text' name='periodo' placeholder='periodo'></input>
		<input type='text' name='descripcion' placeholder='descripcion'></input>
		<input type='text' name='foto' placeholder='foto'></input>
		<input type='checkbox' name='presidente'></input>
		<button type='submit' id="send">Enviar</button>
	</form>
</div>

		{foreach from=$datos item=persona}
			<div class="persona"> 
				<h2>{$persona->nombre}<h2>
				<a href='admin/personas/edit/{$persona->id}'>Editar</a>
				<a href='admin/personas/delete/{$persona->id}'>Eliminar</a>
			</div>
		{/foreach}
</article>

<script type="text/javascript" src="includes/js/abm_personas.js"></script>
