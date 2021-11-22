<!DOCTYPE html>
        <html lang="en">
        <head>
            <base href="'.BASE_URL.'" />
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/index.css"><!--POR FALLA EN APLICACION DE ESTILOS USAR ASI-->            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    
    <form action="API/addComment" method="post">
        <input type="text" name="comment" placeholder="comente aqui..." required>
        1<input type="radio" name="radio" value="1" checked>
        2<input type="radio" name="radio" value="2" >
        3<input type="radio" name="radio" value="3" >
        4<input type="radio" name="radio" value="4" >
        5<input type="radio" name="radio" value="5" >
        <input type="submit" value="enviar">
    </form>
    <div id="comments-container">
    <!--AQUI VAN LOS COMENTARIOS QUE SE TRAEN DESDE LA API-->
    </div>
</div>
    <a class="btn btn-primary" href="../home">volver</a>
    
{include file="templates/footer.tpl"}