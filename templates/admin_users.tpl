{include file="templates/header.tpl"}
<article id="contenido">
	<h1 class="tituloPpal"> Administrador DB Usuarios </h1>
		{foreach from=$datos item=usuario}
			<div class="persona"> 
				<h2>{$usuario->email}<h2>
				<a href='admin/users/permissions/{$usuario->id}'>Cambiar Permisos</a>
				<a href='admin/users/delete/{$usuario->id}'>Eliminar</a>
			</div>
		{/foreach}
</article>

