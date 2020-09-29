// JavaScript Document
import initScripts from './scripts.js';

document.addEventListener("DOMContentLoaded", (e) =>{
	
	init(e);
	
	async function init(e){
		e.preventDefault();
		let page = document.querySelector("body");
		try{
			let index = await fetch("inicio");
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
		let url = "";

		if (window.location.search !== ""){
			url = window.location.search.substr(1);
			contenido = await fetch(url);
		}
		else{
			contenido = await fetch("personas");
		}
		if (contenido.ok){
			let text = await contenido.text();
			container.innerHTML = text;
			history.replaceState(null, null, url);
		}
	}
	
});

