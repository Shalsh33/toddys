{include file="templates/header.tpl"}
<a href="admin" id="back"><img src="includes/img/back.png" alt="back"></a>
<article id="contenido">
	<h1 class="tituloPpal"> Administrador DB Usuarios </h1>
		{foreach from=$datos item=usuario}
			<div class="persona"> 
				<h2>{$usuario->email}<h2>
				<a href='admin/users/{$usuario->id}'>Editar</a>
			</div>
		{/foreach}
</article>

