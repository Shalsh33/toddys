'use strict';

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let links = document.querySelectorAll("a");
	
	links.forEach( link => {
		if (link.id){
			link.addEventListener("click", (e)=>{
			
				e.preventDefault();
				fetch(`admin/personas/${link.id}`).then (response => response.text()).then(html => {document.querySelector("#contenido").innerHTML=html});
			
			
			});
		}
		
	});
});