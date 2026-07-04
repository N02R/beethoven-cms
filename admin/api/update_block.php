<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../core/Database.php';

$data = json_decode(file_get_contents("php://input"), true);

$id    = $data['id'] ?? null;
$value = $data['value'] ?? '';

if (!$id) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing ID'
    ]);
    exit;
}

$db = Database::getInstance()->connection();

$stmt = $db->prepare("
    UPDATE blocks
    SET content = :value
    WHERE id = :id
");

$success = $stmt->execute([
    'id'    => $id,
    'value' => $value
]);

echo json_encode([
    'success' => $success,
    'message' => $success ? 'Saved' : 'Failed'
]);