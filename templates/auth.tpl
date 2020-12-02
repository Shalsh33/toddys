{include file="templates/header.tpl"}

<article id="login">
	
	
	<form class="login" action="login" method="post">
	
		<label for="user">Usuario</label>
		<input type="text" name="user" placeholder="Usuario">
	  
		<label for="pass">Password</label>
		<input type="password" name="pass" placeholder="Contraseña">
		<button type="submit" class="btn btn-dark">Entrar</button>
	
	</form>
	<h2> 
	¿No tienes una cuenta? 
	<a href="registro"><button type="button" class="btn btn-dark">¡Regístrate!</button></a>
	</h2>
	
	{if $error}
		<h1 class="rojo">El usuario o la contraseña ingresados son incorrectos</h1>
	{/if}
	

</article>

