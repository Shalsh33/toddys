<html>
	<head>
		<base href="{BASE_URL}">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
		
		<footer>

			<section class="logo">
				
				<a href="inicio"> <img src="includes/img/logo.png" alt="inicio" /></a>
				
			</section>
			
			<section id="developer">
			
				<p> Desarrollado por TuVieja </p>

			</section>

</footer>

<script type="module" src="includes/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>