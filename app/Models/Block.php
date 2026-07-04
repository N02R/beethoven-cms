<?php

class Block
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

    public function getBySection(int $section_id)
    {
        $stmt = $this->db->prepare("
            SELECT field_name, content 
            FROM blocks 
            WHERE section_id = :section_id
        ");

        $stmt->execute([
            'section_id' => $section_id
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $result[$row['field_name']] = $row['content'];
        }

        return $result;
    }
}