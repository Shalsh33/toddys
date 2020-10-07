<html>
	<head>
		<base href="{BASE_URL}">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="includes/css/style.css">
		<title> Bloque de Todos </title>
	</head>
	
	<body>
		<header>
		
			<nav id="nav" class="navhide"> <!--Se define la barra de navegación-->
		
				<div class="logochico"> <!--El primer div va a llevar el logo-->
					<a href= "inicio"> 
						<img src="includes/img/logo.png" alt="inicio"/>
					</a> 
				</div> <!--Fin del div logo-->

				<img id="btn-barra" src="includes/img/icono-menu.png" alt="toggle menú"/>
				
				<section id="navLinks"> <!--Div para la lista de navegación-->
					<ul> <!--Se define la lista para la barra de navegación-->
						<a class="nav" href="inicio"><li>Inicio</li></a>
						<a class="nav" href="comisiones"><li>Comisiones</li></a>
						<a class="nav" href="contacto"><li>Contacto</li></a>
						<a class="nav" href="login"><li>Soy miembro</li></a>
						{if $sesion} 
							<li> Logueado como {$user} - <a class="nav" id="logout" href="logout">desconectarse</a><li>
						{else}
							<li> Bienvenido, {$user}</li>
						{/if}
						
					</ul>
				</section><!-- fin de la sección de links-->

			</nav> <!--Fin de la barra de navegación-->
			
		</header>
		