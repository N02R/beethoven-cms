<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
|---------------------------
| CORE
|---------------------------
*/

require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/bootstrap.php';

/*
|---------------------------
| MODELS
|---------------------------
*/

require_once __DIR__ . '/../app/Models/Page.php';
require_once __DIR__ . '/../app/Models/Section.php';
require_once __DIR__ . '/../app/Models/Block.php';

/*
|---------------------------
| CONTROLLERS
|---------------------------
*/

require_once __DIR__ . '/../app/Controllers/Controller.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';

/*
|---------------------------
| INIT APP
|---------------------------
*/

$request = new Request();
$router  = new Router();

/*
|---------------------------
| ROUTES
|---------------------------
*/

$router->get('/', 'HomeController@index');
echo "ROUTER REACHED"; exit;
/*
|---------------------------
| RUN
|---------------------------
*/

$router->resolve($request);