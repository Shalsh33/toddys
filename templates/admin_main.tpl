{include file='header.tpl'}

<article id="contenido">
	{if $level > 0}
		<section>
			<a href='admin/personas'>Ver DB personas</a>
		</section>

		<section>
			<a href='admin/comisiones'>Ver DB comisiones</a>
		</section>
		{if $level > 1}
			<section>
				<a href='admin/users'>Ver DB usuarios</a>
			</section>
		{/if}
	{else}
		<h2> ¿Estás perdido chiquitín? ¡Contacta con un administrador! </h2>
	{/if]
	
</article>

{include file='footer.tpl'}