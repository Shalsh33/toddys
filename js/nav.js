// JavaScript Document

export default function nav(){
	
	let query = window.matchMedia("(min-width: 1024px)");
	let btnMenu = document.querySelector("#btn-barra");
	let nav = document.querySelector("#nav");
	
	let tope; /*tope de la barra de nav*/
	let logochico = document.querySelector(".logochico");
	
	if(query.matches){
		nav.classList.remove("navhide");
		tope = nav.offsetTop; /*le damos el valor del tope superior de la barra en la resolución actual*/
		window.addEventListener("scroll", fijar);
	}else{
		btnMenu.addEventListener("click", toggleMenu);
	}
	
	
	window.addEventListener("resize", () =>{
		if (query.matches){
			nav.classList.remove("navhide");
			nav.classList.remove("navshow");
			tope = nav.offsetTop; /*le damos el valor del tope superior de la barra en la resolución actual*/
			window.addEventListener("scroll", fijar);
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
	
	function fijar() {
		/* Si el valor del eje Y de nuestra página es superior al tope (O sea, si ya "scrolleamos" en la página una distancia mayor que la distancia de la barra de nav con respecto al top del body)*/
	  if (window.pageYOffset > tope) { /* pageYOffset devuelve el valor de scroll en el eje Y*/
		  nav.classList.add("fijo"); /* Le agregamos la clase "fijo" a la barra (que en el css define posición fija en top = 0)*/
	  } else { /* En cambio, cuando el valor de scroll ya es menor al valor original de posición relativa de la barra*/
		  nav.classList.remove("fijo"); /* Quitamos la clase "fijo", lo que devuelve su posicionamiento relativo al body*/
	  }
	}
	

}
