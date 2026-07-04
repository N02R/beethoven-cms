<?php

require_once __DIR__ . '/../core/Database.php';

$db = Database::getInstance()->connection();

echo "DB Connected Successfully 🚀";