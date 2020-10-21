//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let forms = document.querySelectorAll("form");
	
	forms.forEach(form =>{
		form.addEventListener('submit', sendForm);
	});
	
	async function sendForm(e){
		e.preventDefault();
		let id = window.location.pathname.substr(window.location.pathname.lastIndexOf('/')+1);
		const data = new URLSearchParams(new FormData(this));
		
		let request = await fetch(`admin/personas/${id}/${this.id}`, {
									method: 'POST',
									body: data,
									});
		if (request.ok){
			let text = await request.text();
			this.innerHTML = text;
			setTimeout( ()=>{ window.location.reload();},3000);
		} else {
			this.innerHTML = "Error de conexión, intente nuevamente más tarde";
			setTimeout( ()=>{ window.location.reload();},3000);
		}
		
		
		
		
	}
	
});