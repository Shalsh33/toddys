// JavaScript Document
/*Redirige desde los html de contenido a la página principal*/
let path = window.location.pathname.substr(0, window.location.pathname.lastIndexOf('/'));
let query = window.location.pathname.substr((window.location.pathname.lastIndexOf('/')+1),window.location.pathname.lastIndexOf('l'));
window.location= path + "/index.html?" + query;
/*Envía la página que estabamos viendo como search para que la pagina vuelva a mostrar lo mismo*/
