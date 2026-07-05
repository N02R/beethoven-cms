<?php
class Block
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

    public function getBySection(int $section_id): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM blocks 
            WHERE section_id = :section_id
        ");

        $stmt->execute([
            'section_id' => $section_id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return is_array($result) ? $result : [];
    }
}