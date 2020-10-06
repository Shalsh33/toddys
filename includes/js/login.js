//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let form = document.querySelector("form");
	
	form.addEventListener('submit', function(e){
		
		e.preventDefault();
		const data = new URLSearchParams(new FormData(this));
		
		fetch(`login/send`, {
			method: 'post',
			body: data,
		});
		
	});
	
});