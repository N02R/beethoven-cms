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

/*
|--------------------------------------------------------------------------
| BASE PATH
|--------------------------------------------------------------------------
*/

define('BASE_PATH', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| SIMPLE AUTOLOADER (🔥 الحل الحقيقي لمشكلة Class not found)
|--------------------------------------------------------------------------
*/

spl_autoload_register(function ($class) {

    $paths = [
        BASE_PATH . '/app/Controllers/',
        BASE_PATH . '/app/Models/',
        BASE_PATH . '/core/',
    ];

    foreach ($paths as $path) {

        $file = $path . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});