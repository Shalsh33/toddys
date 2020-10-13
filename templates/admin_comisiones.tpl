{include file='header.tpl'}

<h1> Administrador DB comisiones </h1>
<ul>
	{foreach from=$datos item=comision}
		<li> 
			<h2>{$comision->nombre}<h2>
			<a class='btn btn-danger btn-sm' href='admin/comisiones/edit/{$comision->id}'>Editar</a>
		</li>
	{/foreach}
</ul>

{include file='footer.tpl'}