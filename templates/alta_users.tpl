{include file="templates/header.tpl"}

<article>
	<h1 class="tituloPpal">Registro</h1> 
	
</article>
<article>
		<form>
		<div>
			<label for="user">Ingrese su usuario:</label>
			<input type="text" id="user" name="user" placeholder="username" required></input>
		</div>
		<div>
			<label for="email">Su Email generado:</label>
			<input type="email" id= "email" name="email" placeholder="user@todos.com.ar" readonly></input>
		</div>
		<div>
			<label for="password">Ingrese su contraseña:</label>
			<input type="password" name="password" placeholder="******" required> </input>
		</div>
			<button type='submit' id="{$action}">Registrarse</button>
		</form>
		
</article>
<script type="text/javascript" src="includes/js/add_users.js"></script>
