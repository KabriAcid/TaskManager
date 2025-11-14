<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';
require_once __DIR__ . '/../../includes/helpers/functions.php';

header('Content-Type: application/json');

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email']) || !isset($input['password'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Email and password are required'
    ]);
    exit;
}

$email = $input['email'];
$password = $input['password'];

$result = loginUser($email, $password);

if ($result['success']) {
    echo json_encode([
        'success' => true,
        'user' => $result['user']
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => $result['message']
    ]);
}
