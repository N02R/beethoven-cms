<?php

header('Content-Type: application/json');

require_once dirname(__DIR__, 3) . '/core/Database.php';

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

/*
|--------------------------------------------------------------------------
| Validate input
|--------------------------------------------------------------------------
*/

if (!isset($data['blocks'])) {

    echo json_encode([
        'success' => false,
        'message' => 'No blocks received'
    ]);

    exit;
}

$blocks = $data['blocks'];

try {

    $db = Database::getInstance()->connection();

    /*
    |--------------------------------------------------------------------------
    | Update blocks
    |--------------------------------------------------------------------------
    */

    $stmt = $db->prepare("
        UPDATE blocks 
        SET content = :content 
        WHERE id = :id
    ");

    foreach ($blocks as $block) {

        $stmt->execute([
            'id'      => $block['id'],
            'content' => $block['value']
        ]);

    }

    echo json_encode([
        'success' => true,
        'message' => 'Database updated successfully',
        'updated' => $blocks
    ]);

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => 'Database error',
        'error' => $e->getMessage()
    ]);

}