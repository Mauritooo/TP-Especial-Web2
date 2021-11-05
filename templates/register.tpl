{include file="templates/header.tpl"}

    <h1> {$titulo} </h1>

        <form action="userRegister" method="POST">
            <input type="text" name="user" id="user" placeholder="ingrese el nuevo usuario">
            <input type="password" name="password" id="password" placeholder="ingrese su password">
            <input type="submit" class="btn btn-primary" value="Registrar">
        </form>

        <h2>{$error}</h2>

{include file="templates/footer.tpl"}