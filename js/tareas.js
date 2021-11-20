'use strict'

// template compilado
let templateTareas;

// llamado ajax para traer el template de tareas (en Smarty seria el .tpl)
fetch('js/templates/tareas.handlebars')
.then(response => response.text())
.then(template => {
    // compilo el template
    templateTareas = Handlebars.compile(template); 

    getTareas();
});


function getTareas() {
    fetch('api/tareas')
    .then(response => {
        if (response.ok)
            return response.json();
    })
    .then(jsonTareas => renderTareas(jsonTareas));    
}

function renderTareas(tareas) {

    // creamos el contexto (assign de smarty)
    let context = {
        tasks: tareas
    };
    let html = templateTareas(context);
    document.querySelector("#container-tareas").innerHTML = html;
}
