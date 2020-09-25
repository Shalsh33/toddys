

export default function initTable(){
	tabla();
}

function tabla(){
	
	let map = new Map();
	
	let dB = "http://web-unicen.herokuapp.com/api/groups";
	let grupo = "/09sheddenmartinez";
	let coleccion = "/productos";
	let url = dB +  grupo + coleccion;
	
	let selectID;
	
	/*Elementos en caché*/
	let servicio = document.querySelector("#servicio");
	let size = document.querySelector("#size");
	let costo = document.querySelector("#costo");
	let descuento = document.querySelector("#descuento");
	let tabla = document.querySelector("#cuerpoTabla");
	let estatus = document.querySelector("#estatusCarga");
	
	
	let btnAdd = document.querySelector("#add");
	btnAdd.addEventListener("click", function (e){
		e.preventDefault();
		if (servicio.value){
			let producto = {
				"thing": {
					"servicio" : servicio.value[0].toUpperCase() + servicio.value.slice(1).toLowerCase(), //Convertimos la primera letra a mayúsculas
					"size" : size.value,
					"costo" : costo.value,
					"descuento" : descuento.checked,
				}
			};
			rest(producto);
		}
		else{
			estatus.innerHTML = "Se deben completar todos los campos";
			estatus.classList.add("rojo");
			estatus.classList.remove("verde");
		}
	});
	
	//Boton de agregar 3 elementos al azar
	let btnAdd3R = document.querySelector("#add3r");
	btnAdd3R.addEventListener("click", function (e){
		e.preventDefault();
		let medidas = ["A3", "A4", "A5", "A6", "Personalizado"];
		for (let i=0;i<3;i++){
			let val_servicio = obtenerStringAleatorio();
			let val_size = medidas[Math.floor(Math.random() * medidas.length)];
			let val_costo = obtenerIntAleatorio(150,600);
			let producto = {
				"thing": {
					"servicio" : val_servicio,
					"size" : val_size,
					"costo" : val_costo,
					"descuento" : false
				}
			};
			rest(producto);
		}
	});
	
	//Boton borrar elemento
	let btnErase = document.querySelector("#erase");
	btnErase.addEventListener("click", function (e){
		e.preventDefault();
		if(servicio.value){
			let val_servicio = servicio.value[0].toUpperCase() + servicio.value.slice(1).toLowerCase();
			let producto = {
				"thing": {
					"servicio" : val_servicio,
					"size" : size.value,
					"costo" : costo.value,
					"descuento" : false
				}
			};
			del(producto);
		}
		else{
			del();
		}
	});

	async function del(objeto){
		if (objeto && inDB(objeto) && selectID){
			let resp = await fetch(url + "/" + selectID,
			{
				'method' : 'DELETE', 
				'mode': 'cors', 
				'headers' : { 
					'Content-Type' : 'application/json'
				}, 
				'body' : JSON.stringify(objeto)	
			});
			if (resp.ok){
				estatus.innerHTML = "El objeto seleccionado ha sido eliminado";
				estatus.classList.add("verde");
				estatus.classList.remove("rojo");
			}
			cargaTabla();
		}
		else if (objeto){
			estatus.innerHTML = "El objeto no se encuentra en la tabla";
			estatus.classList.add("rojo");
			estatus.classList.remove("verde");
		}
		else{
			let i=0;
			map.forEach((producto,id) =>{
				if (i === (map.size-1)){
					selectID = id
				}
				i++;
			});
			let resp = await fetch(`${url}/${selectID}`,
			{
				'method' : 'DELETE', 
				'mode': 'cors', 
				'headers' : { 
					'Content-Type' : 'application/json'
				}, 
				'body' : JSON.stringify(objeto)	
			});
			if (resp.ok){
				estatus.innerHTML = "El objeto ha sido eliminado";
				estatus.classList.add("verde");
				estatus.classList.remove("rojo");
			}
			else{
				fail();
			}
			cargaTabla();
				
			
		}
	}
	
	function obtenerStringAleatorio(){
		let chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		let cadena = "";
		for (let i=0; i<7;i++){
			cadena += chars[Math.floor(Math.random() * chars.length)];
		}
		cadena = cadena[0].toUpperCase() + cadena.slice(1); //Transformar la primer letra a mayúsculas
		return cadena;
	}
	
	function obtenerIntAleatorio(min, max){
		let int = Math.floor(Math.random() * (max-min) + min);
		return int;
	}
	
	async function rest(objeto){
		let comp = await inDB(objeto, true);
		console.log(comp);
		if ((!comp)){
			post(objeto);
		}
		else if (selectID){
			put(objeto);
		}
		else{
			yaCargado();
		}
	}
	
	function yaCargado(){
		estatus.innerHTML = "El objeto ya se encuentra en la tabla";
		estatus.classList.add("rojo");
		estatus.classList.remove("verde");
	}
	
	async function inDB(objeto, busquedaCompleta = false){
		let existe = false;
		map.forEach( (producto, id) =>{
			console.log(`producto ${producto}`);
			producto = JSON.parse(producto);
			
			if ((producto.servicio === objeto.thing.servicio) && (producto.size === objeto.thing.size)){
				
				if (busquedaCompleta){
				
					if ((producto.costo !== objeto.thing.costo) || (producto.descuento !== objeto.thing.descuento)){
						selectID = id;
					}
					else{
						selectID = null;
						
					}
				}else{
					selectID = id;
				}
				existe = true;
				
			}
		});
		return existe;
	}
	
	async function put(objeto){
		let resp = await fetch(url + "/" + selectID,
		{
			'method' : 'PUT', 
			'mode': 'cors', 
			'headers' : { 
				'Content-Type' : 'application/json'
			}, 
			'body' : JSON.stringify(objeto)	
		});
		if (resp.ok){
			estatus.innerHTML = "El objeto ha sido actualizado";
			estatus.classList.add("verde");
			estatus.classList.remove("rojo");
		}
		cargaTabla();
	}
	
	async function post(objeto){
		let resp = await fetch(url,
			{ 
				'method' : 'POST', 
				'mode': 'cors', 
				'headers' : { 
					'Content-Type' : 'application/json'
				}, 
				'body' : JSON.stringify(objeto)
			});
		cargaTabla();
	}
	
	cargaTabla();
	async function cargaTabla(){
		/*obtengo todos los datos*/
		let get = await fetch(url);
		let datos_tabla = await get.json();
		actualizarTabla(datos_tabla.productos);
	}
	
	function actualizarTabla(array) {
		tabla.innerHTML = "";
		map.clear(); /*Vacia el mapa*/
		for (let objeto of array){
			let producto = objeto.thing;
			let fila = tabla.insertRow();
			let columna = fila.insertCell(0);
			columna.innerHTML = producto.servicio;
			columna = fila.insertCell(1);
			columna.innerHTML = producto.size;
			columna = fila.insertCell(2);
			columna.innerHTML = `$ ${producto.costo}`;
			if (producto.descuento){
				fila.classList.add("descuento");
			}
			map.set(objeto._id, JSON.stringify(producto));
			fila.addEventListener("click", (e) =>{
				servicio.value = producto.servicio;
				size.value = producto.size;
				costo.value = producto.costo;
				
			})
			}
		selectID=null;
	}
	
	function fail(){
		estatus.innerHTML = "Error en la comunicación con el servidor";
		estatus.classList.add("rojo");
		estatus.classList.remove("verde");
	}
	
	//Boton de limpiar campos
	let btnClear = document.querySelector("#clear");
	btnClear.addEventListener("click", function (e){
		e.preventDefault();
		servicio.value = "";
		size.value = "A3";
		costo.value = "";
		descuento.checked = false;
	});
}

//fetch("http://web-unicen.herokuapp.com/api/groups/09sheddenmartinez/productos",{ 'method' : 'POST', 'mode': 'cors', 'headers' : { 'Content-Type' : 'application/json'}, 'body' : '{ "servicio" : "Cuadernos personalizados", "size" : "A3", "costo" : 650}'}).then(r =>{ return r.json;});
/*function cargaTabla(){
	"use strict";
	
	//Arreglo de datos de la tabla con elementos precargados
	let datos_tabla = [
		{
			"servicio" : "Cuadernos personalizados",
			"size" : "A3",
			"costo" : 650,
			"descuento" : false
		},
		{
			"servicio" : "Cuadernos personalizados",
			"size" : "A4",
			"costo" : 550,
			"descuento" : false
		},
		{
			"servicio" : "Cuadernos personalizados",
			"size" : "A5",
			"costo" : 450,
			"descuento" : false
		}
	]; 
	
	//Variables auxiliares
	let flag_modif = false; //Bandera que se activa cuando hay un elemento a modificar
	let indice_repeticion; //Guarda el índice de la búsqueda selectiva
	
	//Elementos en caché
	let servicio = document.querySelector("#servicio");
	let size = document.querySelector("#size");
	let costo = document.querySelector("#costo");
	let descuento = document.querySelector("#descuento");
	let tabla = document.querySelector("#cuerpoTabla");
	let estatus = document.querySelector("#estatusCarga");
	
	//Primera carga de la tabla
	actualizarTabla();
	
	//boton de Agregar
	let btnAdd = document.querySelector("#add");
	btnAdd.addEventListener("click", function (e){
		e.preventDefault();
		if (campos()){
			let fila = {
				"servicio" : servicio.value[0].toUpperCase() + servicio.value.slice(1).toLowerCase(), //Convertimos la primera letra a mayúsculas
				"size" : size.value,
				"costo" : costo.value,
				"descuento" : descuento.checked,
			};
			cargarDatos(fila);
		}
		else{
			estatus.innerHTML = "Se deben completar todos los campos";
			estatus.classList.add("rojo");
			estatus.classList.remove("verde");
		}
	});

	//Boton de agregar 3 elementos al azar
	let btnAdd3R = document.querySelector("#add3r");
	btnAdd3R.addEventListener("click", function (e){
		e.preventDefault();
		let medidas = ["A3", "A4", "A5", "A6", "Personalizado"];
		for (let i=0;i<3;i++){
			let val_servicio = obtenerStringAleatorio();
			let val_size = medidas[Math.floor(Math.random() * medidas.length)];
			let val_costo = obtenerIntAleatorio(150,600);
			let fila = {
				"servicio" : val_servicio,
				"size" : val_size,
				"costo" : val_costo,
				"descuento" : false
			};
			cargarDatos(fila);
		}
	});
	
	//Boton de limpiar campos
	let btnClear = document.querySelector("#clear");
	btnClear.addEventListener("click", function (e){
		e.preventDefault();
		servicio.value = "";
		size.value = "A3";
		costo.value = "";
		descuento.checked = false;
	});
	
	//Boton borrar elemento
	let btnErase = document.querySelector("#erase");
	btnErase.addEventListener("click", function (e){
		e.preventDefault();
		if(servicio.value){
			let val_servicio = servicio.value[0].toUpperCase() + servicio.value.slice(1).toLowerCase();
			let fila = {
				"servicio" : val_servicio,
				"size" : size.value,
				"costo" : costo.value,
				"descuento" : descuento.checked,
			};
			eliminarElemento(fila);
		}
		else{
			eliminarElemento();
		}
	});
	
	//Botón borrar tabla
	let btnEraseAll = document.querySelector("#eraseall");
	btnEraseAll.addEventListener("click", function (e){
		e.preventDefault();
		datos_tabla = [];
		actualizarTabla();
		estatus.innerHTML = "Tabla vaciada";
		estatus.classList.remove("rojo");
		estatus.classList.add("verde");
	})
	
	

	function eliminarElemento(fila=""){
		
		if ((fila==="") && (datos_tabla)){ //si toma el valor por defecto y tengo elementos en la tabla
			let elim = datos_tabla.pop(); //saco el último elemento de la tabla
			actualizarTabla();
			estatus.innerHTML = "Elemento eliminado con éxito";
			estatus.classList.remove("rojo");
			estatus.classList.add("verde");
		}
		else if (repetido(fila)){
			datos_tabla.splice(indice_repeticion,1);
			flag_modif = false; //Se desactiva la bandera por si se hubiera llegado a activar
			actualizarTabla();
			estatus.innerHTML = "Elemento eliminado con éxito";
			estatus.classList.remove("rojo");
			estatus.classList.add("verde");
		}
		else {
			estatus.innerHTML = "El elemento no se encuentra en la tabla";
			estatus.classList.add("rojo");
			estatus.classList.remove("verde");
		}
	}
		
	
	
	function campos(){ //compruebo que los campos de "servicio" y "costo" estén cargados
		if ((servicio.value) && (costo.value)){
			return true;
		}
		return false;
	}
	
	function obtenerStringAleatorio(){
		let chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		let cadena = "";
		for (let i=0; i<7;i++){
			cadena += chars[Math.floor(Math.random() * chars.length)];
		}
		cadena = cadena[0].toUpperCase() + cadena.slice(1); //Transformar la primer letra a mayúsculas
		return cadena;
	}
	
	function obtenerIntAleatorio(min, max){
		let int = Math.floor(Math.random() * (max-min) + min);
		return int;
	}
	
	
	function repetido(fila){
		let rep = false;
		for (let indice in datos_tabla){ //para cada elemento del arreglo de los datos
			let objeto = datos_tabla[indice];
			for (let atributo in objeto){ //y para cada índice dentro de ese elemento
				
					if (fila[atributo] !== objeto[atributo]){ //si los valores de los atributos a comparar son distintos
						//comprobación de actualización de precios
						if ((rep) && ((atributo === "costo") || (atributo === "descuento"))){ //si el objeto es igual pero cambia el costo, el descuento
							flag_modif = true; //activo la bandera de modificaciones
							break; //rompo el for porque ya sé que es una actualización
						}
						else{
							rep = false; //sé que no es el mismo objeto que estoy trabajando
							break; //rompo el for, no necesito comparar más atributos
						}
					}
					else{
						rep = true; //sino, marco que es un elemento repetido
					}
				
			}
			if (rep){ //si luego de comparar todos los atributos del objeto, descubro que está repetido
				indice_repeticion = indice;
				break; //ya no comparo más objetos
			}
		}
		return rep; //devuelvo el valor de la variable booleana
	}
	
	function cargarDatos(fila){
		if (! (repetido(fila)) ){ //Si el objeto no está ya cargado
			datos_tabla.push(fila); //lo agrego al arreglo
			actualizarTabla();
			estatus.innerHTML = "Elemento cargado con éxito";
			estatus.classList.remove("rojo");
			estatus.classList.add("verde");
		}
		else if(flag_modif) { // si activé la bandera de modificaciones
			datos_tabla[indice_repeticion].costo = fila.costo;
			datos_tabla[indice_repeticion].descuento = fila.descuento;
			actualizarTabla();
			flag_modif = false; //desactivo la bandera
			estatus.innerHTML = "Elemento modificado con éxito";
			estatus.classList.remove("rojo");
			estatus.classList.add("verde");
		}
		else {
			estatus.innerHTML = "El elemento ya está cargado en la tabla";
			estatus.classList.add("rojo");
			estatus.classList.remove("verde");
		}
	}

	
	
}*/