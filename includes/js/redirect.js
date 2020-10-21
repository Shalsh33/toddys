// JavaScript Document
/*Redirige desde las páginas de contenido a la página principal*/
let path = window.location.pathname.substr(0, window.location.pathname.lastIndexOf('/'));
let query = window.location.search;
console.log(query);
window.location= path + "/inicio" + query;
/*Envía la página que estabamos viendo como search para que la pagina vuelva a mostrar lo mismo*/

