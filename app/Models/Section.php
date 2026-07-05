<?php

class Section
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

    /**
     * جلب Sections حسب الصفحة
     */
    public function getByPage(int $page_id): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM sections 
            WHERE page_id = :page_id 
            ORDER BY position ASC
        ");

        $stmt->execute([
            'page_id' => $page_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}