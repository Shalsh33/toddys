//JavaScript Document
'use strict'

document.addEventListener('DOMContentLoaded', (e) =>{
	
	let form = document.querySelector("form");
	let button = document.querySelector("button");
	let action = button.id.split('_');
	
	form.addEventListener('submit', function(e){
		
		e.preventDefault();
		
		const data = new URLSearchParams(new FormData(this));
		if(action[0] != "registro"){
			fetch(`admin/users/${action[0]}`, {
				method: 'post',
				body: data,
			}) . then(response => response.text()) .then(html => {form.innerHTML= html;});
		} else {
			fetch(`registro/${action[0]}`, {
				method: 'post',
				body: data,
			}) . then(response => response.text()) .then(html => {form.innerHTML= html;});
		}
	
});

	if (action[0] == "registro"){
		let user = document.querySelector("#user");
		let email = document.querySelector("#email");
		
		user.addEventListener("keyup", function (e){
			
			email.value = this.value + "@todos.com.ar";
			
		});

}

});