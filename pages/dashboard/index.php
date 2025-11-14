<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/helpers/session.php';
require_once __DIR__ . '/../../includes/helpers/functions.php';
require_once __DIR__ . '/../../includes/database/db.php';

// Require authentication
requireAuth();

$currentUser = getCurrentUser();
$pageTitle = 'Dashboard';

// Include appropriate dashboard based on role
if ($currentUser['role'] === 'Admin') {
    include __DIR__ . '/admin.php';
} elseif ($currentUser['role'] === 'Manager') {
    include __DIR__ . '/manager.php';
} else {
    include __DIR__ . '/employee.php';
}
