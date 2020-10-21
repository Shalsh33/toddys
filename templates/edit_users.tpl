{include file="templates/header.tpl"}

<article>
	<h1 class="tituloPpal"> Administrador usuarios => {$usuario->email}</h1> 
	
</article>
<article>
		<form method="post" id="usuario">
			<input type='text' name='email' value="{$usuario->email}" readonly></input>
			<select form="usuario" name="role">
				<option value="usuario" {if $usuario->role eq "usuario"} selected {/if}>usuario</option>
				<option value="admin" {if $usuario->role eq "admin"} selected {/if}>admin</option>
				<option value="super admin" {if $usuario->role eq "super admin"} selected {/if}>super admin</option>
			</select>
			<button type='submit' id="update_{$usuario->id}">Enviar</button>
		</form>
		
	
		<h1>¿Está usted seguro de querer eliminar el usuario? (Esta acción no se puede deshacer)</h1>
		<form>
			<input type="text" name="id" id="id" value="{$usuario->id}" readonly></input>
			<button type='submit' id="elim/{$usuario->id}">Banhammer</button>
		</form>
		
</article>
<script type="text/javascript" src="includes/js/abm_users.js"></script>
