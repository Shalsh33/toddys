<script type="text/javascript" src="includes/js/check.js"></script>
<article id="contenido">
<h1> Administrador DB personas </h1>
<ul>
	{foreach from=$datos item=persona}
		<li> 
			<h2>{$persona->nombre}<h2>
			<a id='edit/{$persona->id}' href=" ">Editar</a>
		</li>
	{/foreach}
</ul>
</article>
<script type="text/javascript" src ="includes/js/form_edit.js"></script>
