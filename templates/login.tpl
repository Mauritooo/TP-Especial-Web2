{include file="templates/header.tpl"}

    <h1> {$titulo} </h1>

        <form action="verifyLogin" method="POST">
            <input type="text" name="user" id="user" placeholder="ingrese el usuario">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>

        <h2>{$error}</h2>

<a class="btn btn-primary" href="home">volver</a>

{include file="templates/footer.tpl"}
