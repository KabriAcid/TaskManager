<?php
require_once __DIR__ . '/../config/config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireAuth()
{
    if (!isLoggedIn()) {
        header('Location: ' . APP_URL . '/pages/auth/login.php');
        exit;
    }
}

function getCurrentUser()
{
    if (!isLoggedIn()) {
        return null;
    }
    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email'],
        'avatar' => $_SESSION['user_avatar'],
        'role' => $_SESSION['user_role']
    ];
}

function setUserSession($user)
{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_avatar'] = $user['avatar'];
    $_SESSION['user_role'] = $user['role'];
}

function destroySession()
{
    session_unset();
    session_destroy();
}
