{include file="templates/header.tpl"}

{if $usuario != null}
    <h1>Bienvenido: {$usuario->username}!</h1>
{else}
    <h1>Bienvenido: Anonimo!</h1>
{/if}
    
<a class="btn btn-success" href="register">register</a>
<a class="btn btn-danger" href="logout">logout</a>
<a class="btn btn-primary" href="login">login</a>
<a class="btn btn-dark" href="viewCategories">Ver Categorias</a>
<h2> POR FAVOR INICIE SESION O REGISTRESE PARA ACCEDER A MAS OPCIONES<h2>
    <h1>{$titulo}</h1>

    
    {foreach from=$productosConCategoria item=$producto}
        <div class="show-product">

            <div>
                <img class="imagen" src="{$producto->imagen}" alt="{$producto->nombre}">
            </div>
            
            <ul>        
                    <li>Id: {$producto->id_producto}</li>
                    <li>Nombre: {$producto->nombre} </li>
                    <li>Descripcion: {$producto->descripcion}</li> 
                    <li>Precio: ${$producto->precio}</li> 
                    <li>Categoria: {$producto->categoria}</li> 
            </ul>
            
            <div>
                <a class="btn btn-primary" href="viewProduct/{$producto->id_producto}">ver</a>    
            </div>

        </div>
    {/foreach}

{include file="templates/footer.tpl"}