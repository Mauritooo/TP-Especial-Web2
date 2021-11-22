<?php

require_once 'libs/Router.php';
require_once 'Api/Controller/CommentApiController.php';

$r = new Router();

// rutas de la api
$r->addRoute("comentarios","GET", "CommentApiController", "getComments");//addRoute(RECURSO,VERBO,CONTROLLER,METODO) //obtiene todos los comentarios para CSR
$r->addRoute("comentarios/:ID", "GET", "CommentApiController", "getComments");//comentarios de un producto id producto SSR
$r->addRoute("comentarios/:ID", "DELETE", "CommentApiController", "deleteComment");
$r->addRoute("comentarios", "POST", "CommentApiController", "addComment");
$r->addRoute("comentarios/:ID","PUT", "CommentApiController", "updateComment");

//run
$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
