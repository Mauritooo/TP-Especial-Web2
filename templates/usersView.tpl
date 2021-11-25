{include file="templates/header.tpl"}
    <h1>{$titulo}</h1>
        <div>
            {if $users}
                {foreach from=$users item=$user}
                    <div class="usersViewStyle">
                    <h5>Usuario: {$user->username} - Tipo de permiso: {if $user->admin} <span class="admin">Admin</span>{else}<span class="user">user</span>{/if} - </h5>
                    {if $myUser}
                        <a class="btn btn-danger" href="deleteUser/{$user->username}">Borrar</a>
                        <form action="reasignLevel/{$user->username}" method="post">
                            conceder permisos: <input type="radio" value="1" name="radio" required>
                            revocar permisos: <input type="radio" value="0" name="radio" checked>
                            <input type="submit" class="btn btn-info" value="enviar">
                        </form>
                    {/if}
                    </div>
                {/foreach}
                {else}
                    <h2>No hay Usuarios Registrados!</h2>
            {/if}
            
        </div>
        <a class="btn btn-primary" href="./home">volver</a>
    
{include file="templates/footer.tpl"}