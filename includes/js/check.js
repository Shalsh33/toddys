//JavaScript Document
import navScript from './scripts.js';


let query = window.location.pathname.substr(window.location.pathname.lastIndexOf('/')+1);
let request = window.location.search.substr(1);

fetch('header').then(response => response.text()).then(html => {
	let body = document.querySelector("body");
	body.innerHTML = html
	navScript();
	fetch(query).then(response => response.text()).then(html => {
		html = html.substr(html.indexOf('\n'));
		let contenido = document.querySelector("#contenido")
		contenido.innerHTML = html});
		if (request){
			
			console.log(`${query}/${request}`)
			fetch(`${query}/${request}`).then(response => response.text()).then (texto => {
				let section = document.createElement("section");
				texto = texto.substr(texto.indexOf('\n'));
				section.classList.add("emergente");
				section.innerHTML = texto;
				contenido.appendChild(section);
			});
			
		}

});

