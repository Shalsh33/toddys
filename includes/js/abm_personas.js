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
			if (id.value != action[1]){
				action[0] = ""; //No hago acción, pues se modificó algún valor del html
			}
		}
		const data = new URLSearchParams(new FormData(this));
		
		fetch(`admin/personas/${action[0]}`, {
			method: 'post',
			body: data,
		}) . then(response => response.text()) .then(html => {form.innerHTML= html;});

		
	});
	
});