{literal}
<h3>Caja de Comentarios:</h3>

<div class="caja-comentarios" id="comments-vue-view">
    <div class="caja-comentarios" v-for="comment in comments">
        <p><span>Usuario: </span>{{comment.username}}<span> - Dijo: </span>{{comment.comentario}}<span> - Califico con un: </span>{{comment.calificacion}}</p>
        <button v-on:click.prevent="deleteComentario(comment.id_comentario)" id="btn-borrar" :data-id_comentario= "comment.id_comentario" >Borrar</button>
    </div>
</div>
{/literal}