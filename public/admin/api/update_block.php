<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../core/Database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['blocks'])) {

    echo json_encode([
        'success' => false,
        'message' => 'No data received'
    ]);

    exit;

}

$blocks = $data['blocks'];

try {

    $db = Database::getInstance()->connection();

    // فقط تجربة (بدون حفظ فعلي الآن)
    echo json_encode([
        'success' => true,
        'message' => 'Data received successfully',
        'received' => $blocks
    ]);

} catch(Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);

}