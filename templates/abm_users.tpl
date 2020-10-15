{include file="header.tpl"}

<article>
	<h1 class="tituloPpal"> Administrador usuarios => {$action}</h1> 
	
</article>
<article>
	{if $action eq "registro"}
		<form>
		<div>
			<label for="username">Ingrese su usuario:</label>
			<input type="text" name="username" placeholder="username"></input>
		</div>
		<div>
			<label for="email">Su Email generado:</label>
			<input type="email" name="email" placeholder="user@todos.com.ar" readonly></input>
		</div>
		<div>
			<label for="password">Ingrese su contraseña:</label>
			<input type="password" name="password" placeholder="******"> </input>
		</div>
			<button type='submit' id="{$action}">Registrarse</button>
		</form>
	{else if $action eq "editar"}
	
		<form method="post">
			<input type='text' name='email' value="{$user->email}" readonly></input>
			<input type='select'>
				<option name="usuario" {if user->role eq "usuario"} selected>usuario</option>
				<option name="admin" {if user->role eq "admin"} selected>admin</option>
				<option name="super admin" {if user->role eq "super admin"} selected>super admin</option>
			</input>
			<button type='submit' id="update_{$user->id}">Enviar</button>
		</form>
		
		
	{else}
	
		<h1>¿Está usted seguro de querer eliminar el usuario? (Esta acción no se puede deshacer)</h1>
		<form>
			<input type="text" name="id" id="id" value="{$user->id} readonly></input>
			<button type='submit' id="elim/{$user->id}>Banhammer</button>
		</form>
		
		
	{/if}
		
</article>
<script type="text/javascript" src="includes/js/abm_users.js"></script>
{include file="footer.tpl"}