<?php

require_once __DIR__ . '/../core/bootstrap.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/Controllers/Controller.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';

$request = new Request();
$router = new Router();

/*
|---------------------------
| Routes
|---------------------------
*/

$router->get('/', 'HomeController@index');

/*
|---------------------------
| Run App
|---------------------------
*/

$router->resolve($request);