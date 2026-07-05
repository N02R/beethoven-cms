<?php
class Section
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

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

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return is_array($result) ? $result : [];
    }
}