<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';

if (isLoggedIn()) {
    echo json_encode([
        'success' => true,
        'user' => getCurrentUser()
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Not authenticated'
    ]);
}
