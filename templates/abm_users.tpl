

<article>
	<h1 class="tituloPpal"> Administrador usuarios => {$action}</h1> 
	
</article>
<article>
	{if $action eq "registro"}
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
	{else if $action eq "edit"}
	
		<form method="post" id="usuario">
			<input type='text' name='email' value="{$usuario->email}" readonly></input>
			<select form="usuario" name="role">
				<option value="usuario" {if $usuario->role eq "usuario"} selected {/if}>usuario</option>
				<option value="admin" {if $usuario->role eq "admin"} selected {/if}>admin</option>
				<option value="super admin" {if $usuario->role eq "super admin"} selected {/if}>super admin</option>
			</select>
			<button type='submit' id="update_{$usuario->id}">Enviar</button>
		</form>
		
		
	{else}
	
		<h1>¿Está usted seguro de querer eliminar el usuario? (Esta acción no se puede deshacer)</h1>
		<form>
			<input type="text" name="id" id="id" value="{$usuario->id}" readonly></input>
			<button type='submit' id="elim/{$usuario->id}">Banhammer</button>
		</form>
		
		
	{/if}
		
</article>
<script type="text/javascript" src="includes/js/abm_users.js"></script>
