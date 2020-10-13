//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let form = document.querySelector("form");
	let button = document.querySelector("button");
	
	form.addEventListener('submit', function(e){
		
		e.preventDefault();
		
		let action = button.id.split('_');
		if (action[0] != "send"){
			let id = document.querySelector("#id");
			id.value = action[1];
		}
		const data = new URLSearchParams(new FormData(this));
		
		fetch(`admin/comisiones/${action[0]}`, {
			method: 'post',
			body: data,
		}) . then(response => response.text()) .then(html => {form.innerHTML= html;});
		
		setTimeout(function() {
			
			window.location.replace("admin/comisiones");

			
		},3000);
		
	});
	
});