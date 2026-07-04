<?php

require_once __DIR__ . '/../core/bootstrap.php';
require_once __DIR__ . '/../core/Request.php';

$request = new Request();

echo "URI: " . $request->uri();
echo "<br>";
echo "METHOD: " . $request->method();