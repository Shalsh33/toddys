//JavaScript Document
'use strict'



document.addEventListener("DOMContentLoaded",(e)=>{
	
	
	let contenido = document.querySelector("#contenido");
	let emergente = document.querySelector("#emergente");
	let personas;
	let back;
	
	if (window.location.search){
		let persona = window.location.search.substr(1);
		fetch(`personas/${persona}`).then(response => response.text()).then (html =>{
			window.history.pushState({},'',`personas?${persona}`);
			emergente.innerHTML= html;
			contenido.innerHTML = "";
			emergente.classList.toggle("dnone");
			contenido.classList.toggle("dnone");
			back = document.querySelector("#back");
			setTimeout(()=>{
				back.addEventListener("click",clickBack);
			},0);
			comentarios();
		});
		
	} else {
		fetch ('personas').then(response=>response.text()).then(html=>{
			contenido.innerHTML=html;
			window.history.replaceState({},'','personas');
			eventsPersonas();
		});
	}
	
	function eventsPersonas(){
		
		
		personas = document.querySelectorAll("section");
	
		personas.forEach(persona =>{
			
			if (persona.classList[0] == "presidente" || persona.classList[0] == "persona"){
				let id = persona.id;
				let nombre = persona.querySelector(".nombre");
				nombre = normalize(nombre.textContent);
				persona.addEventListener("click", function (){
					fetch(`personas/${id}`).then(response => response.text()).then (html =>{
						
						window.history.pushState({},'',`personas?${nombre}`);
						emergente.innerHTML= html;
						contenido.innerHTML = "";
						emergente.classList.toggle("dnone");
						contenido.classList.toggle("dnone");
						back = document.querySelector("#back");
						setTimeout(()=>{
							back.addEventListener("click",clickBack);
						},0);
						comentarios();
					});
			
				});
			}
		});	
	}
	
	
	async function comentarios(){
		const app = new Vue({
			el: "#comments",
			data: {
				comments : []
			},
			methods : {
				eliminar : function(e) {
					e.preventDefault();
					deleteComment();
				}
			}
		});
	
		let id = window.location.search.substr(1);;
		console.log(id);
		const request = await fetch(`api/comments/${id}`);
	
		const data = await request.json();
	
		if (Array.isArray(data)){
			app.comments = data;
		} else {
			app.comments.push(data);
		}
		
	}

	let clickBack = (e) =>{
		e.preventDefault();
		ocultarEmergente();
	};
	
	function ocultarEmergente(){
		back.removeEventListener("click",clickBack);
		emergente.innerHTML= "";
		emergente.classList.toggle("dnone");
		contenido.classList.toggle("dnone");
		fetch ('personas').then(response=>response.text()).then(html=> {
			window.history.pushState({},'',`personas`);
			contenido.innerHTML = html;
			setTimeout(()=>{
				eventsPersonas();
			},0);
		});
	}
	
	function normalize(texto){
		
		texto = texto.replace(/ /g, '+'); 
		texto =texto.replace(/á/g, 'a'); 
		texto =texto.replace(/é/g, 'e'); 
		texto =texto.replace(/í/g, 'i'); 
		texto =texto.replace(/ó/g, 'o'); 
		texto =texto.replace(/ú/g, 'u'); 
		return (texto);
		
	}
	
});