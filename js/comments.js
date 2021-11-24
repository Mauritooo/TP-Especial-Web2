'use strict'

let API_URL = "http://localhost/web2/codigo/electrizante/api/comentarios";


document.querySelector("#btn-form").addEventListener('click',addComment);

//------------------------------------------------------------------
let app = new Vue({
    el:"#comments-vue-view",
    
    data:{
        comments: [],
    },
    methods:{
            deleteComentario: function(nro_btn){
            deleteComment(nro_btn);
            }
        }
    }
)
//------------------------------------------------------------------
async function getComments(){
    try {
        let id_producto = comment_form.getAttribute('data-id_producto');
        let response = await fetch(API_URL+'/'+id_producto);

        if(response.ok){
            let comments = await response.json();
            app.comments = comments;
            app.comentario = comments[0];
            }

    } catch (error) {
        console.log(error);
    }
}
//------------------------------------------------------------------
function createComment(){

    let id_producto = comment_form.getAttribute('data-id_producto');
    let id_usuario = comment_form.getAttribute('data-id_usuario');
    let comentario = comment_form.querySelector('#comentario').value;
    let calificacion = comment_form.querySelector('#puntuacion').value;

    let comment = {
        "id_producto": id_producto,
        "id_usuario": id_usuario,
        "comentario": comentario,
        "calificacion": calificacion
    };

    console.log(comment);
    return comment;
    
}
//------------------------------------------------------------------
async function addComment(e){
    e.preventDefault();
    let comment = createComment();
    try {
        let response = await fetch(API_URL,{
            "method": "POST",
            "headers": { "Content-Type": "application/json"},
            "body":JSON.stringify(comment)
        })

        if(response.ok){
            getComments();
            document.querySelector("#btn-borrar").addEventListener('click',deleteComment);}

        else
            if(response.status == 201)
                console.log('http 201');
            else
                console.log("http error");
    } catch (error) {
        console.log(error);
    }
}
//------------------------------------------------------------------
async function deleteComment(nro_btn){

    console.log('entra al deleteComment:');
    try {
        let response = await fetch(API_URL+"/"+nro_btn ,{
            "method": "DELETE"})
        console.log('entra al try del deleteComment con id_comentario:');
        console.log(nro_btn);
        if(response.ok){
            console.log('Se elimino con Exito!');
            getComments();
        }
        else
            if(response.status == 201)
                console.log('http 201');
            else
                console.log("http error - NO SE PUDO ELIMINAR!");
    } catch (error) {
        console.log(error);
    }
}

document.addEventListener("DOMContentLoaded", getComments);

