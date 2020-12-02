"use strict";

document.addEventListener("DOMContentLoaded", (e) =>{

    const buttons = document.querySelectorAll(".img-control");
    const div = document.querySelector(".fotos");

    buttons.forEach(button =>{
        let data = button.dataset;
        let id = data.id;
        let action = data.action;
        button.addEventListener("click", e=>{
            e.preventDefault();
            console.log("click");
            call(id,action);
        }); 
    });

    async function call(id,action,data=null){

        let params= {method: 'POST', body:data};
        let url = `imagenes/${id}/${action}`;
        const req = await fetch(url,params);
        const resp = await req.text();

        div.innerHTML = resp;
        setTimeout( ()=>{window.location.reload();},1000);
    }

    const form = document.querySelector("#replace");

    form.addEventListener("submit", add);
    
    
    function add(e){
        e.preventDefault();
        const data = new FormData(this);
        /*let foto = document.querySelector("#foto");
        let reader= new FileReader();
        let file = foto.files[0];
        console.log(file);
        reader.readAsDataURL(file);
        data.append("foto", file);*/
		
        let id = form.dataset.id;
        let action = form.dataset.action;
        console.log(data==null);
        call(id,action,data);
    };

    
});