<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../core/Database.php';

/*
|--------------------------------------------------------------------------
| قراءة الـ JSON القادم من fetch
|--------------------------------------------------------------------------
*/

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

/*
|--------------------------------------------------------------------------
| Debug: إذا لم يصل أي JSON
|--------------------------------------------------------------------------
*/

if (!$data) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid JSON or empty request',
        'raw' => $raw
    ]);
    exit;
}

/*
|--------------------------------------------------------------------------
| التحقق من وجود blocks
|--------------------------------------------------------------------------
*/

if (!isset($data['blocks'])) {
    echo json_encode([
        'success' => false,
        'message' => 'blocks key missing',
        'data' => $data
    ]);
    exit;
}

$blocks = $data['blocks'];

/*
|--------------------------------------------------------------------------
| اختبار الاتصال فقط (بدون حفظ حاليًا)
|--------------------------------------------------------------------------
*/

try {

    $db = Database::getInstance()->connection();

    echo json_encode([
        'success' => true,
        'message' => 'API working correctly',
        'received_blocks' => $blocks
    ]);

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => 'Database error',
        'error' => $e->getMessage()
    ]);

}