// JavaScript Document
import initScripts from './scripts.js';

document.addEventListener("DOMContentLoaded", (e) =>{
	
	init(e);
	
	
	async function init(e){
		e.preventDefault();
		let page = document.querySelector("body");
		page.innerHTML = "<h1> loading </h1>";
		try{
			let index = await fetch("index");
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
			contenido = await fetch("index");
		}
		if (contenido.ok){
			let text = await contenido.text();
			container.innerHTML = text;
			container.scrollIntoView( {behavior: "smooth"} );
			history.replaceState(null, null, url);
		}
	}
	
});

