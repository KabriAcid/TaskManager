<?php
require_once __DIR__ . '/../../includes/config/config.php';
require_once __DIR__ . '/../../includes/auth/session.php';

// Destroy session
destroySession();

// Redirect to login
header('Location: ' . APP_URL . '/index.php');
exit;
