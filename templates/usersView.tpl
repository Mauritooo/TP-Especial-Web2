{include file="templates/header.tpl"}
    <h1>{$titulo}</h1>
        <div>
            {if $users}
                {foreach from=$users item=$user}
                    <h5>Usuario: {$user->username} - Permiso: {$user->admin}.</h5>
                    {if $myUser}
                        <a class="btn btn-danger" href="deleteUser/{$user->username}">Borrar</a>
                    {/if}
                {/foreach}
                {else}
                    <h2>No hay Usuarios Registrados!</h2>
            {/if}
            
        </div>
    <br>
        <a class="btn btn-primary" href="./home">volver</a>
    
{include file="templates/footer.tpl"}