//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let forms = document.querySelectorAll("form");
	
	forms.forEach(form=>{

		form.addEventListener('submit', function(e){
		
			e.preventDefault();
			
			const data = new URLSearchParams(new FormData(this));
			let action = form.id;
			let id = window.location.pathname.substr(window.location.pathname.lastIndexOf('/')+1);
			fetch(`admin/comisiones/${id}/${action}`, {
				method: 'post',
				body: data,
			}) . then(response => response.text()) .then(html => {form.innerHTML= html;});
		
			setTimeout( ()=>{ window.location.reload();},1000);
		});
	});

});