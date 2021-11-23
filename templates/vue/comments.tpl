{literal}
<h3>Caja de Comentarios:</h3>
<div id="template-vue-comments">
    <div v-for="comment in comments">
    {{comment.id_comentario}}
        <p>Usuario: {{comment.username}} - Dijo: {{comment.comentario}} - Califico con un: {{comment.calificacion}}</p>
        <div><input type="button" data-btn-borrar="btn-borrar" :data-id_comentario= "comment.id_comentario" value="borrar"></div>
    </div>
</div>
{/literal}