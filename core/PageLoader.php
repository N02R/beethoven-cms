<?php

require_once __DIR__ . '/Database.php';

class PageLoader {

    public static function load($pdo, $slug) {

        $stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = ? LIMIT 1");
        $stmt->execute([$slug]);

        return $stmt->fetch();
    }

}