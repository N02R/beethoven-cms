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
    'id' => (int)$id,
    'value' => $value
]);

// تأكيد التحديث
$stmt2 = $db->prepare("SELECT content FROM blocks WHERE id = ?");
$stmt2->execute([$id]);
$check = $stmt2->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    'success' => $success,
    'db_value' => $check['content'] ?? null
]);

exit;