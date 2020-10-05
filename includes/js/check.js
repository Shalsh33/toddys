//JavaScript Document
'use strict';
let path = <?php BASE_URL ?>;
let query = window.location.pathname.substr((path.lenght),(window.location.pathname.lenght-1));

fetch('header').then(reponse=>response.text()).then(html => {document.querySelector("body").innerHTML = html});
fetch(query).then(response=>response.text()).then(html => {document.querySelector("#contenido").innerHTML = html});

document.write('<!--'); 
