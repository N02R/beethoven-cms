<?php

class Block
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->connection();
    }

    /**
     * جلب Blocks حسب Section
     */
    public function getBySection(int $section_id)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM blocks 
            WHERE section_id = :section_id
        ");

        $stmt->execute([
            'section_id' => $section_id
        ]);

        return $stmt->fetchAll();
    }
}