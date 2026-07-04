<?php

require_once __DIR__ . '/../core/bootstrap.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/PageLoader.php';

$pageSlug = Router::getPage();

$page = PageLoader::load($pdo, $pageSlug);

if (!$page) {
    echo "404 - Page Not Found";
    exit;
}

echo "<h1>" . htmlspecialchars($page['title']) . "</h1>";
echo "<div>" . $page['content'] . "</div>";