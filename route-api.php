<?php

require_once 'libs/Router.php';
require_once 'API/ApiController.php';

$r = new Router();

// rutas de la api
$r->addRoute("comentarios","GET", "ApiController", "getComments");//(RECURSO,VERBO,CONTROLLER,METODO)
$r->addRoute("comentarios/:ID", "GET", "ApiController", "getComments");
$r->addRoute("comentarios/:ID", "DELETE", "ApiController", "deleteComment");
$r->addRoute("comentarios", "POST", "ApiController", "addComment");
$r->addRoute("comentarios/:ID","PUT", "ApiController", "editComment");

//run
$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
