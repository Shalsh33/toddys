// JavaScript Document
import initScripts from './scripts.js';
import initTable from './table.js';

document.addEventListener("DOMContentLoaded", (e) =>{
	
	init(e);
	
	
	async function init(e){
		e.preventDefault();
		let page = document.querySelector("body");
		page.innerHTML = "<h1> loading </h1>";
		try{
			let index = await fetch("body.html");
			if (index.ok){
				let texto = await index.text();
				
				page.innerHTML = texto;
					
				initScripts();
				cargaContenido();
				
			}
			else{
				page.innerHTML = "<h1> Error </h1>";
			}
		}
		catch (error){

		}

	}
	
	async function cargaContenido(){
		let container = document.querySelector("#contenido");
		let contenido;
		let url = " ";

		if (window.location.search !== ""){
			url = window.location.search.substr(1);
			contenido = await fetch(url+"#contenido");
		}
		else{
			contenido = await fetch("nosotros.html");
		}
		if (contenido.ok){
			let text = await contenido.text();
			container.innerHTML = text;
			if (url === "tabla.html"){
				initTable();
			}
			container.scrollIntoView( {behavior: "smooth"} );
			history.replaceState(null, null, url);
		}
	}
	
});

