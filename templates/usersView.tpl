{include file="templates/header.tpl"}
<h1>{$titulo}</h1>
<div>
    {foreach from=$users item=$user}
        <div>Usuario: {$user->username} - Permiso: {$user->admin}.</div>
        <a class="btn btn-danger" href="deleteUser/{$user->username}">Borrar</a>
        
    <!-- <form action="reasignLevel/{$user->username}" method='POST'>
        <select name="levels" id="levels">
            <option value="">Elige una opción</option>
            <option class='nivel0' name='nivel 0' id='nivel 0' value="nivel 0">Nivel 0</option>
            <option class='nivel1' name='nivel 1' id='nivel 1' value="nivel 1">Nivel 1</option>
            <option class='nivel2' name='nivel 2' id='nivel 2' value="nivel 2">Nivel 2</option>
        </select>
        <input type="submit" class="btn btn-dark" value="Asignar Nivel">
        </form>-->
    {/foreach}
</div>
<br>
<!--<div>
    <h5>Niveles de accesso que puede conceder: </h5>
    <h6 class="nivel0">nivel de Acceso 0 : Visitante</h6>
    <h6 class="nivel1">nivel de Acceso 1 : Usuario</h6>
    <h6 class="nivel2">nivel de Acceso 2 : Usuario con derechos</h6>
</div>-->
    <a class="btn btn-primary" href="./home">volver</a>
    
{include file="templates/footer.tpl"}