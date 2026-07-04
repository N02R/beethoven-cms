<?php

require_once __DIR__ . '/../core/bootstrap.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Router.php';

require_once __DIR__ . '/../core/Database.php';

require_once __DIR__ . '/../app/Controllers/Controller.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Models/Page.php';

$request = new Request();
$router = new Router();

/*
|---------------------------
| ROUTES
|---------------------------
*/

$router->get('/', 'HomeController@index');

/*
|---------------------------
| RUN APP
|---------------------------
*/

$router->resolve($request);