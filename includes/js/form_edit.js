'use strict';

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let links = document.querySelectorAll("a");
	
	links.forEach( link => {
		
		link.addEventListener("click", (e)=>{
			if (link.id){
				e.preventDefault();
				fetch(`admin/personas/${link.id}`).then (response => response.text()).then(html => {document.querySelector("#contenido").innerHTML=html});
			}
			
		});
		
	});
});