<?php
require_once __DIR__ . '/../includes/config/config.php';
require_once __DIR__ . '/../includes/auth/session.php';

// Check if user is logged in
if (isLoggedIn()) {
    // Redirect to dashboard
    header('Location: ' . APP_URL . '/pages/dashboard/index.php');
} else {
    // Redirect to login
    header('Location: ' . APP_URL . '/pages/auth/login.php');
}
exit;
