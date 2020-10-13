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
						<a class="nav" href="admin"><li>Soy miembro</li></a>
						{if $sesion} 
							 <a class="nav" id="logout" href="logout"><li> <div> Logueado como {$user} </div> Desconectarse<li></a>
						{else}
							<a class="nav" href="login"><li><div> Bienvenido {$user}</div> Loguearse</li></a>
						{/if}
						
					</ul>
				</section><!-- fin de la sección de links-->

			</nav> <!--Fin de la barra de navegación-->
			
		</header>
		