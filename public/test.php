<?php

require_once __DIR__ . '/../core/bootstrap.php';

$stmt = $pdo->query("SELECT 1");
echo "CMS Database Connected ✔";