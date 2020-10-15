//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let personas = document.querySelectorAll(".persona");
	let presidente = document.querySelector(".presidente");
	let emergente = document.querySelector("#emergente");
	
	personas.forEach(persona =>{
		
		persona.addEventListener("click", (e)=>{
			
			window.location.href = `personas/${persona.id}`;
		});
		
	});
	presidente.addEventListener("click", (e)=>{
			
			window.location.href = `personas/${presidente.id}`;
		});

			
			/*fetch(`personas/${persona.id}`).then(response => response.text()).then (html =>{
				
				emergente.innerHTML= html;
				emergente.classList.remove("hidden");
				emergente.classList.add("visible");
				window.addEventListener("click",clickOutEmergente);
				
			});
		
	});
	});
	
	presidente.addEventListener("click", (e)=>{
			
			fetch(`personas/${presidente.id}`).then(response => response.text()).then (html =>{
				
				emergente.innerHTML= html;
				emergente.classList.remove("hidden");
				emergente.classList.add("visible");
				window.addEventListener("click",clickOutEmergente);
				
			});
		
	});
	
	
	let clickOutEmergente = function(e){
		if (!(emergente.contains(e.target))){
			ocultarEmergente();
		} 
	};
	
	function ocultarEmergente(){
		div.classList.remove("visible");
		div.classList.add("hidden");
		window.removeEventListener("click",clickOutDiv);
	}*/
	
});