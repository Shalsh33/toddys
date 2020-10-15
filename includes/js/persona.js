//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let personas = document.querySelectorAll(".persona");
	let presidente = document.querySelector(".presidente");
	let emergente = document.querySelector("#emergente");
	
	personas.forEach(persona =>{
		
		persona.addEventListener("click", (e)=>{
			
			fetch(`personas/${persona.id}`).then(response => response.text()).then (html =>{
				
				emergente.innerHTML= html;
				emergente.classList.remove("hidden");
				emergente.classList.add("visible");
				window.addEventListener("click",clickEmergente);
				
			});
		
	});
	});
	
	presidente.addEventListener("click", (e)=>{
			
			fetch(`personas/${presidente.id}`).then(response => response.text()).then (html =>{
				
				emergente.innerHTML= html;
				emergente.classList.remove("hidden");
				emergente.classList.add("visible");
				window.addEventListener("click",clickEmergente);
				
			});
		
	});
	
	
	let clickEmergente = function(e){
			ocultarEmergente();
	};
	
	function ocultarEmergente(){
		emergente.classList.remove("visible");
		emergente.classList.add("hidden");
		window.removeEventListener("click",clickEmergente);
	}
	
});