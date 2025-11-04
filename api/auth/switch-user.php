<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';
require_once __DIR__ . '/../../includes/database/db.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['userId'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'User ID is required'
    ]);
    exit;
}

$userId = $input['userId'];
$user = getUserById($userId);

if (!$user) {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'User not found'
    ]);
    exit;
}

// Set new user session
setUserSession($user);

echo json_encode([
    'success' => true,
    'user' => $user
]);
