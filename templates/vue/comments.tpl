{literal}
<h3>Caja de Comentarios:</h3>
<div id="comments-vue-view">
    <div v-for="comment in comments">
        {{comment.id_comentario}}
        <p>Usuario: {{comment.username}} - Dijo: {{comment.comentario}} - Califico con un: {{comment.calificacion}}</p>
        <button v-on:click.prevent="deleteComentario(comment.id_comentario)" id="btn-borrar" :data-id_comentario= "comment.id_comentario" >Borrar</button>
    </div>
    
</div>
{/literal}