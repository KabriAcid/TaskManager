<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';
require_once __DIR__ . '/../../includes/database/db.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: ' . APP_URL . '/pages/dashboard/index.php');
    exit;
}

// For demo purposes, auto-login as Admin
$users = getAllUsers();
$adminUser = $users[0]; // Admin User

// Set session
setUserSession($adminUser);

// Redirect to dashboard
header('Location: ' . APP_URL . '/pages/dashboard/index.php');
exit;
