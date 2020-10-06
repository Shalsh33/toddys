

<article id="contenido">
	{if $error}
		<h1 class="tituloPpal">El usuario o la contraseña ingresados son incorrectos</h1>
	{/if}
	
	<form action="login/send" method="post">
	
		<label for="user">Usuario</label>
		<input type="text" name="user" placeholder="Usuario">
	  
		<label for="pass">Password</label>
		<input type="password" name="pass" placeholder="Contraseña">
		<button type="submit">Entrar</button>
	
	</form>
	
	<!--script type="text/javascript" src="includes/js/login.js"></script-->

</article>

