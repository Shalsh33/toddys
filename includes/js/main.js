// JavaScript Document
import initScripts from './scripts.js';

document.addEventListener("DOMContentLoaded", (e) =>{
	
	init(e);
	
	async function init(e){
		let asd = document.querySelectorAll("nav");
		console.log(asd);
		initScripts();
		console.log(asd);
		cargaContenido();	
		console.log(asd);

	}
	
	async function cargaContenido(){
		let container = document.querySelector("#contenido");
		let contenido;
		let url = "";

		if (window.location.search !== ""){
			url = window.location.search.substr(1);
			console.log(url);
			contenido = await fetch(url);
		}
		else{
			contenido = await fetch("personas");
			console.log("personas");
		}
		if (contenido.ok){
			let text = await contenido.text();
			container.innerHTML = text;
			history.replaceState(null, null, url);
		}
	}
	
});

