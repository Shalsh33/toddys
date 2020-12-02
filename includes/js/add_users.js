//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let form = document.querySelector("form");
	
	form.addEventListener('submit', add);
	
	let user = document.querySelector("#user");
	let email = document.querySelector("#email");
		
	user.addEventListener("keyup", function (e){
			
		email.value = this.value + "@todos.com.ar";
			
	});
	
	async function add(e){
		
		e.preventDefault();
		const data = new URLSearchParams(new FormData(this));
		
		let request = await fetch(`registro`, {
									method: 'POST',
									body: data,
								});
		if (request.ok){
			let text = await request.text();
			this.innerHTML = text;
			setTimeout( ()=>{ window.location.href = `inicio`;},1000);
		} else {
			this.innerHTML = "Error de conexión, intente nuevamente más tarde";
			setTimeout( ()=>{ window.location.reload;},3000);
		}
	}

});

		