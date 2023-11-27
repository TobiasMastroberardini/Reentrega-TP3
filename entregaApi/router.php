<?php

require_once 'config.php';
require_once 'libs/router.php';
require_once 'app/controller/subscripciones.controller.php';

$router = new Router();

$router->addRoute('subscripciones', 'GET', 'subscripciones.controller', 'get');
$router->addRoute('subscripcionesCreciente',     'GET',    'subscripciones.controller', 'getCreciente');
$router->addRoute('subscripcionesDecreciente',     'GET',    'subscripciones.controller', 'getDecreciente');
$router->addRoute('subscripcion',     'POST',   'subscripciones.controller', 'create');
$router->addRoute('subscripcion/:ID', 'GET',    'subscripciones.controller', 'get');
$router->addRoute('subscripcion/:ID', 'PUT',    'subscripciones.controller', 'update');
$router->addRoute('subscripcion/:ID', 'DELETE', 'subscripciones.controller', 'delete');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
