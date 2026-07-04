<?php

/*
|--------------------------------------------------------------------------
| Load Application Configuration
|--------------------------------------------------------------------------
*/

$config = require __DIR__ . '/../config/app.php';


/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
*/

date_default_timezone_set($config['timezone']);


/*
|--------------------------------------------------------------------------
| Application Constants
|--------------------------------------------------------------------------
*/

define('APP_NAME', $config['name']);

define('APP_URL', rtrim($config['url'], '/'));

define('APP_ENV', $config['environment']);

define('APP_DEBUG', $config['debug']);

define('APP_LOCALE', $config['locale']);