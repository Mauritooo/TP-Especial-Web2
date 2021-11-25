<!DOCTYPE html>
        <html lang="en">
        <head>
            <base href="'.BASE_URL.'" />
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/index.css"><!--POR FALLA EN APLICACION DE ESTILOS USAR ASI-->            
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <!-- versión de producción, optimizada para tamaño y velocidad -->
            <script src="https://cdn.jsdelivr.net/npm/vue"></script>

        </head>
    <body>

<h1>Producto Nro: {$producto->id_producto}</h1>
    <div>
        <div>
            <img class="imagen" src="{$producto->imagen}" alt={$producto->nombre}>
        </div>    
        <ul>    
            <li>Nombre: {$producto->nombre}</li>
            <li>Descripcion: {$producto->descripcion}</li>
            <li>Precio: ${$producto->precio}</li>
            <li>Categoria: {$producto->categoria}</li>
        </ul>
        
            
        
        <!--ACA ESTA EL ERROR: EN CASO DEL VISITANTE INTENTA LEVANTAR EL USUARIO CUANDO NO ESTA SETEADO-->
            <form id="comment_form" data-id_producto="{$producto->id_producto}">
                <input type="textarea" id="comentario" name="comentario" placeholder="comente aqui..." required>
                <input id="puntuacion" type="range"   min="1" max="5" step="1" value="5" >
                <input type="submit" value="enviar" id="btn-form">
            </form>
        

        <div id="comments-container">
        {include file="templates/vue/comments.tpl"}
        </div>

    </div>
        <a class="btn btn-primary" href="../home">volver</a>
    
    <script src="../js/comments.js"></script>

{include file="templates/footer.tpl"}