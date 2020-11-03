{include file="templates/header.tpl"}
<article id="contenido">
	<h1 class="tituloPpal"> Administrador DB personas </h1>
<div>
<h2>Agregar persona</h2>
	<form enctype="multipart/form-data">
		<input type='text' name='nombre' placeholder='nombre'></input>
		<input type='text' name='periodo' placeholder='periodo'></input>
		<input type='text' name='descripcion' placeholder='descripcion'></input>
		<input type='file' name='foto[]' placeholder='foto' id="foto" multiple></input>
		<input type='checkbox' name='presidente'></input>
		<button type='submit' id="send">Enviar</button>
	</form>
</div>

		{foreach from=$datos item=persona}
			<div class="persona"> 
				<h2>{$persona->nombre}<h2>
				<a href='admin/personas/{$persona->id}'>Editar</a>
			</div>
		{/foreach}
</article>

<script type="text/javascript" src="includes/js/add.js"></script>
