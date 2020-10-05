// JavaScript Document
export default navScript;


function navScript(){
	

	nav();
	
	function captcha(){
	
		//elementos en caché
		let enviar = document.querySelector("#Enviar"); //Botón de enviar
		let renovar = document.querySelector("#renovarcaptcha"); //Botón de renovar
		let imgCaptcha = document.querySelector(".img-captcha"); //elemento que muestra la imagen del captcha
		let nombre = document.querySelector(".nombre");
		let numero = document.querySelector(".numero");
		let email = document.querySelector(".email");
		let mensaje = document.querySelector(".mensaje");
		let campoCaptcha = document.querySelector(".captcha");
		let aviso = document.querySelector("#advertencia"); //<p> que nos va a servir de aviso para el usuario

		//Variable con el valor del captcha
		let captcha = "";

		//eventos
		enviar.addEventListener("click", validarCaptcha); 
		renovar.addEventListener("click",crearCaptcha); 


		crearCaptcha(); //Cuando se cargue la página, crearemos el 1° captcha

		function crearCaptcha(){
			captcha = ""; //Reiniciamos la variable (Por si ya se encontraba cargada)
			for (let i=0; i<7; i++) {
				let num = Math.floor(Math.random() * 10); //Generamos los dígitos aleatorios
				captcha += num.toString(); //Los vamos concatenando como string en nuestra variable
			}
			crearImagen(captcha); //Por último llamamos a crear la funcion CrearImagen y le pasamos el captcha como parámetro
		}

		function crearImagen(texto) { //Vamos a crear la imagen del captcha con el texto que recibimos como parámetro

			let canvas = document.createElement("canvas").getContext('2d'); //Creamos un elemento <canvas> para dibujar el captcha

			//Le damos un tamaño
			const width = 100; //Se guarda en constantes para que, en caso de que sea necesario sea 
			const height = 40; //más facil de modificar (se cambian los valores de un solo lugar en el código)
			canvas.canvas.width = width;
			canvas.canvas.height = height;

			//Le damos color a todo el fondo
			canvas.fillStyle = "white"; //Seleccionamos el color para el fondo
			canvas.fillRect(0, 0,width,height); //Nos rellena el fondo completamente (desde 0 a 100 en el eje x y 0 a 40 en y)

			//Creamos lineas predefinidas en la imagen
			const mitad = (height / 2)+3; //no es la mitad exacta, pero sino no se ven bien algunos números
			canvas.moveTo(0, mitad);
			canvas.lineTo(width, mitad); //Esta es la linea horizontal por la mitad

			canvas.moveTo(0,0);
			canvas.lineTo(width,height); //Esta es la linea oblicua de el vertice (0,0)(arriba a la izq) al vertice (100,40)(abajo a la der)

			canvas.stroke(); //Stroke nos termina de dibujar las lineas (les da relleno)

			//Por último agregamos el string que contiene el valor del captcha
			canvas.direction = 'ltr'; //left to right (Agrega el valor de izquierda a derecha)
			canvas.font = "22px Arial"; //Elegimos tamaño y fuente
			canvas.fillStyle = "red"; //Seleccionamos el color de la letra
			canvas.fillText(texto, 6,28); //Escribimos el "texto" que recibe la función en la posicion 6 en X y 28 en Y (así queda más o menos centrado)

			imgCaptcha.src = canvas.canvas.toDataURL(); //y a la imagen le damos como "source" el canvas que creamos
		}




		function validarCaptcha(){ //Funcion del boton enviar

			let valor = campoCaptcha.value; //recibimos el valor del input captcha
			valor = valor.split(' ').join(''); //Le sacamos los espacios si el usuario agregó alguno sin querer para evitar errores de capa 8
			if (revisarFormulario()){ 
				if (valor === captcha){ // (La variable captcha ya es string, asique se puede usar el triple igual sin parsear valores)
					aviso.classList.add("verde");
					aviso.classList.remove("rojo");
					aviso.classList.remove("chico"); //Seteamos el color en verde y sacamos los otros modificadores si los tuviera
					aviso.innerHTML = "Mensaje enviado correctamente"; //Avisamos que todo salió bien
					limpiarCampos(); //Limpiamos el form
					crearCaptcha(); //Generamos un nuevo captcha
				} else{ //Si los campos están completos pero el captcha es incorrecto
					aviso.classList.add("rojo");
					aviso.classList.remove("verde");
					aviso.classList.remove("chico"); //Seteamos color en rojo y sacamos los otros modificadores
					aviso.innerHTML = "El captcha ingresado no es válido"; //Avisamos que el captcha es incorrecto
				}
			} else{ //Si el formulario no tiene los campos obligatorios completos
				aviso.classList.add("rojo");
				aviso.classList.remove("verde");
				aviso.innerHTML = "Se deben completar todos los campos obligatorios"; //avisamos que tiene que completar todo
			}

		}

		function revisarFormulario(){ //Funcion para revisar los inputs del form
			if ((nombre.value) && (email.value) && (mensaje.value)){ //Si los tres inputs obligatorios tienen algún elemento
				return true; 
			} else{
				return false; 
			}
		}

		function limpiarCampos(){ //procedimiento que limpia los campos del form
			nombre.value = "";
			numero.value = "";
			email.value = "";
			mensaje.value= "";
			campoCaptcha.value = ""; //Y seteamos su valor en un string vacio
		}
	}
	
	function nav(){

		let query = window.matchMedia("(min-width: 1024px)");
		let btnMenu = document.querySelector("#btn-barra");
		let nav = document.querySelector("#nav");
		let logochico = document.querySelector(".logochico");
		
		let links = document.querySelectorAll(".nav");
		let container = document.querySelector("#contenido");
		
		links.forEach( link =>{
			link.addEventListener("click", (e) =>{
				e.preventDefault();
				partialRender(link.id);
				let state = {inicio : link.id};
				window.history.pushState(state,'',`${link.id}`);
					});
		});

		if(query.matches){
			nav.classList.remove("navhide");
			nav.classList.add("fijo");
		}else{
			btnMenu.addEventListener("click", toggleMenu);
		}


		window.addEventListener("resize", () =>{
			if (query.matches){
				nav.classList.remove("navhide");
				nav.classList.remove("navshow");
				nav.classList.add("fijo");
				btnMenu.removeEventListener("click", toggleMenu);
			}
			else {
				nav.classList.remove("navshow");
				nav.classList.add("navhide");
				nav.classList.remove("fijo");
				btnMenu.src = "img/icono-menu.png";
				btnMenu.addEventListener("click", toggleMenu);
				window.removeEventListener("scroll", fijar);
			}
		});

		async function partialRender(id){
			let link = id;
			let peticion = await fetch(link);
			if (peticion.ok){
				let contenido = await peticion.text();
				contenido.slice((indexOf('\n')));
				container.innerHTML = contenido;
				if (id == 'contacto'){
					captcha();
				}
			}
			history.replaceState(null, null, link);
		}
				
		function toggleMenu() {
			let escondida = nav.classList.toggle("navhide");
			let visible = nav.classList.toggle("navshow");
			if (escondida){
				btnMenu.src = "img/icono-menu.png";
			}
			else {
				btnMenu.src = "img/cerrar-menu.png";
			}
		}


	}

	
}