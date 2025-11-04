<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';

// Destroy session
destroySession();

// Send success response
header('Content-Type: application/json');
echo json_encode(['success' => true]);
?>
