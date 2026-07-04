<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../core/Database.php';

$data = json_decode(file_get_contents("php://input"), true);

$section = $data['section'];
$field   = $data['field'];
$value   = $data['value'];

$db = Database::getInstance()->connection();

/* نحفظ التعديل داخل blocks */
$stmt = $db->prepare("
    UPDATE blocks 
    SET content = :value 
    WHERE section_name = :section 
    AND field_name = :field
");

$success = $stmt->execute([
    'value' => $value,
    'section' => $section,
    'field' => $field
]);

echo json_encode([
    'success' => $success,
    'message' => $success ? 'Saved' : 'Failed'
]);