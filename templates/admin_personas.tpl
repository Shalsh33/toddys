{include file='header.tpl'}

<h1> Administrador DB personas </h1>
<ul>
	{foreach from=$datos item=persona}
		<li> 
			<h2>{$persona->nombre}<h2>
			<a class='btn btn-danger btn-sm' href='admin/personas/edit/{$persona->id}'>Editar</a>
		</li>
	{/foreach}
</ul>

{include file='footer.tpl'}