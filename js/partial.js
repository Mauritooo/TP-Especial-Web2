"use strict";

const contenedor = document.querySelector("#mainContainer");
document.querySelectorAll(".js-verDetalle").forEach(b=> 
    b.addEventListener("click",
        function (event){
            event.preventDefault();
            const url = this.getAttribute("href"); 
            fetch(url+"?partial").then(x=>x.text()).then(texto=>
                contenedor.innerHTML = texto
                );
            history.pushState({},"Detalle Tarea", url);
        }

    )
)