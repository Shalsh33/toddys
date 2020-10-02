// JavaScript Document
export default initScripts;


function initScripts(){
	

	nav();
	
	function nav(){

		let query = window.matchMedia("(min-width: 1024px)");
		let btnMenu = document.querySelector("#btn-barra");
		let nav = document.querySelector("#nav");
		let logochico = document.querySelector(".logochico");
		
		let links = document.querySelectorAll(".nav");
		let container = document.querySelector("#contenido");
		
		links.forEach( link =>{
			link.addEventListener("click", (e) =>{
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