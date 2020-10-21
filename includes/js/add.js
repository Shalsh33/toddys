//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let form = document.querySelector("form");
	
	form.addEventListener('submit', add);
	
	async function add(e){
		
		e.preventDefault();
		const data = new URLSearchParams(new FormData(this));
		
		let tabla = window.location.pathname.substr(window.location.pathname.lastIndexOf('/')+1);
		
		let request = await fetch(`admin/${tabla}`, {
									method: 'POST',
									body: data,
								});
		if (request.ok){
			let text = await request.text();
			this.innerHTML = text;
			setTimeout( ()=>{ window.location.href = `admin/${tabla}`;},3000);
		} else {
			this.innerHTML = "Error de conexión, intente nuevamente más tarde";
			setTimeout( ()=>{ window.location.reload;},3000);
		}
	}

});