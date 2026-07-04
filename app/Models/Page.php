<?php

class Page
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

    /**
     * جلب صفحة حسب slug
     */
    public function find(string $slug)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM pages WHERE slug = :slug LIMIT 1
        ");

        $stmt->execute([
            'slug' => $slug
        ]);

        return $stmt->fetch();
    }

    /**
     * جلب كل الصفحات
     */
    public function all()
    {
        $stmt = $this->db->prepare("
            SELECT * FROM pages
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}