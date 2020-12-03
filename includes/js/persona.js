//JavaScript Document
'use strict'



document.addEventListener("DOMContentLoaded",(e)=>{
	
	
	let contenido = document.querySelector("#contenido");
	let emergente = document.querySelector("#emergente");
	let personas;
	let back;
	
	if (window.location.search){
		let persona = window.location.search.substr(1);
		fetch(`personas/${persona}`).then(response => response.text()).then (html =>{
			window.history.pushState({},'',`personas?${persona}`);
			emergente.innerHTML= html;
			contenido.innerHTML = "";
			emergente.classList.toggle("dnone");
			contenido.classList.toggle("dnone");
			back = document.querySelector("#back");
			setTimeout(()=>{
				back.addEventListener("click",clickBack);
			},0);
			comentarios();
			$('.carousel').carousel({
				interval: 3000
			  })
		});
		
	} else {
		fetch ('personas').then(response=>response.text()).then(html=>{
			contenido.innerHTML=html;
			window.history.replaceState({},'','personas');
			eventsPersonas();
		});
	}
	
	function eventsPersonas(){
		
		
		personas = document.querySelectorAll("section");
	
		personas.forEach(persona =>{
			
			if (persona.classList[0] == "presidente" || persona.classList[0] == "persona"){
				let id = persona.id;
				let nombre = persona.querySelector(".nombre");
				nombre = normalize(nombre.textContent);
				persona.addEventListener("click", function (){
					fetch(`personas/${id}`).then(response => response.text()).then (html =>{
						
						window.history.pushState({},'',`personas?${nombre}`);
						emergente.innerHTML= html;
						contenido.innerHTML = "";
						emergente.classList.toggle("dnone");
						contenido.classList.toggle("dnone");
						back = document.querySelector("#back");
						setTimeout(()=>{
							back.addEventListener("click",clickBack);
						},0);
						comentarios();
						$('.carousel').carousel({
							interval: 3000
						  })
					});
			
				});
			}
		});	
	}
	
	
	async function deleteComment(dataset,app){
		const id = dataset.id;
		const user = dataset.user;
		const req = await fetch(`api/comments/${user}/${id}`,{
			method: 'DELETE'
		});
		if(req.ok){
			const res = await req.json();
			remove(app.comments,id);
		}

		
	}

	function remove(array,id){

		for (let i=0;i<array.length;i++){
			if (array[i].id == id) {
				array.splice( i, 1 );
				break;
			}
		}

	}

	async function comentarios(){
		const app = new Vue({
			el: "#comments",
			data: {
				comments : [{'content' : "Aún no hay comentarios"}],
				id : "",
				user : "",
				permissions : "",
				calificacion : 0,
				comentarios : false,
				more : true,
				page: 1
			},
			methods : {
				eliminar : function(e) {
					e.preventDefault();
					deleteComment(e.target.dataset,this);
				},
				cargarMas : function(e) {
					e.preventDefault();
					this.page++;
					cargaComentarios(this);
				},
				editar : function(e){
					e.preventDefault();
					edit(e.target,this);
				}
			}
		});
		
		let data = document.querySelector("body").dataset;
		app.user = data.u;
		app.permissions = data.p;
		app.id = window.location.search.substr(1);;
		cargaComentarios(app);
		actualizarPromedio(app);
		getCalificacion(app);
		
		
	}

	async function edit(node,vue){

		let botonera = node.parentNode;
		let row = node.parentNode.parentNode;
		let comment = row.childNodes[2];
		let value = comment.childNodes[0].innerHTML;
		comment.innerHTML = "<input type='text' name='modif' value='" + value +"'/>";
		let buttons = botonera.childNodes;
		buttons.forEach(boton =>{
			if(boton.nodeName != "#text"){
				boton.classList.toggle("d-none");
			}
		});
		let send = document.querySelector("#sendEdit");
		let cancel = document.querySelector("#cancelEdit");
		send.addEventListener("click", async function(e){
			e.preventDefault();
			value = document.querySelector("input[name='modif']").value;
			let data = { 'content' : value};
			const req = await fetch(`api/comments/${node.dataset.user}/${node.dataset.id}`,{
				method : 'PUT',
				headers: {
					"content-type": "application/json"
				},
				body: JSON.stringify(data)
			});
			if (req.ok){
				buttons.forEach(boton =>{
					if(boton.nodeName != "#text"){
						boton.classList.toggle("d-none");
					}
				});
				comment.innerHTML = "<p>" + value + "</p>";
			} else {
				window.location.reload();
			}

		});
		cancel.addEventListener("click", (e)=>{
			buttons.forEach(boton =>{
				boton.classList.toggle("d-none");
			});
			comment.innerHTML = "<p>" + value + "</p>";
		})
		

	}

	async function getCalificacion(vue){
		const req = await fetch(`api/calificacion/${vue.id}/${vue.user}`);
		if (req.ok){
			const res = await req.json();
			vue.calificacion = res.valor;
		}
	}

	async function actualizarPromedio(vue){
		const req = await fetch(`api/calificacion/${vue.id}`);

		if (req.ok){
			const res = await req.json();
			let star = document.querySelector("#star");
			star.innerHTML = "";
			for(let i = 0;i<res.prom;i++){
				star.innerHTML += "★";
			}
		}
	}

	async function cargaComentarios(vue){
		const request = await fetch(`api/comments/${vue.id}?page=${vue.page}`);
		
		if (request.ok){
			const data = await request.json();
			if(vue.page == 1 && data){
				vue.comments=[];
			}
			if (Array.isArray(data)){
				
				vue.comments = vue.comments.concat(data);
				vue.comentarios = true;
			} else {
				if (data){
					vue.comments.push(data);
					vue.comentarios = true;
				} else {
					vue.more=false;
				}
			}
		}
		forms(vue);
	}

	async function forms(vue){
		if (vue.user){
			let form = document.querySelector("#add");
			form.addEventListener("submit",async function submit(e){
				e.preventDefault();
				let p = document.querySelector("#send");
				let content = document.querySelector('input[name="content"]');
				if (content.value != ""){
					let data = {'content': content.value }
					let persona = window.location.search.substr(1);
					const req = await fetch(`api/comments/${persona}`,{
						method: 'POST',
						headers: {
							"content-type": "application/json"
						},
						body: JSON.stringify(data)
					});
					if (req.ok){
						let res = await req.json();
						vue.comments.splice(0,0,res);
						content.value = "";
						p.innerHTML = "comentario enviado con éxito";
					}
				} else {
					p.innerHTML = "Se necesita un comentario";
				}
			});

			let calificacion = document.querySelectorAll("input[type='radio']");
			calificacion.forEach(input =>{
				input.addEventListener("change",async function(e){
					let data = {'estrellas' : input.value};
					const req = await fetch(`api/calificacion/${vue.id}`,{
						method : 'POST',
						headers: {
							"content-type": "application/json"
						},
						body: JSON.stringify(data)
					});
					if (req.ok){
						document.querySelector("#info").innerHTML = "Gracias por su calificacion";
						actualizarPromedio(vue);
					} else {
						document.querySelector("#info").innerHTML = "Ocurrió un error, intente de nuevo más tarde";
					}
				})
			})
		}
	}

	let clickBack = (e) =>{
		e.preventDefault();
		ocultarEmergente();
	};
	
	function ocultarEmergente(){
		back.removeEventListener("click",clickBack);
		emergente.innerHTML= "";
		emergente.classList.toggle("dnone");
		contenido.classList.toggle("dnone");
		fetch ('personas').then(response=>response.text()).then(html=> {
			window.history.pushState({},'',`personas`);
			contenido.innerHTML = html;
			setTimeout(()=>{
				eventsPersonas();
			},0);
		});
	}
	
	function normalize(texto){
		
		texto = texto.replace(/ /g, '+'); 
		texto =texto.replace(/á/g, 'a'); 
		texto =texto.replace(/é/g, 'e'); 
		texto =texto.replace(/í/g, 'i'); 
		texto =texto.replace(/ó/g, 'o'); 
		texto =texto.replace(/ú/g, 'u'); 
		return (texto);
		
	}
	
	

});