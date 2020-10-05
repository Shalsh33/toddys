// JavaScript Document
import navScript from './scripts.js';

document.addEventListener("DOMContentLoaded", (e) =>{
	navScript();
	fetch('inicio').then(response => response.text()).then(html => {
		html = html.substr(html.indexOf('\n'));
		document.querySelector("#contenido").innerHTML = html
	});
});

