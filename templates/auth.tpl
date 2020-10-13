{include file="templates/header.tpl"}

<article id="login">
	
	
	<form class="login" action="login/send" method="post">
	
		<label for="user">Usuario</label>
		<input type="text" name="user" placeholder="Usuario">
	  
		<label for="pass">Password</label>
		<input type="password" name="pass" placeholder="Contraseña">
		<button type="submit">Entrar</button>
	
	</form>
	
	{if $error}
		<h1 class="rojo">El usuario o la contraseña ingresados son incorrectos</h1>
	{/if}
	

</article>

{include file="templates/footer.tpl"}