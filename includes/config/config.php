<?php
// Application Configuration
define('APP_NAME', 'TaskManager Pro');
define('APP_URL', 'http://localhost/TaskManager/php-task-manager');
define('BASE_PATH', dirname(dirname(__DIR__)));

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'taskmanager');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Session Configuration
define('SESSION_LIFETIME', 3600); // 1 hour in seconds

// Timezone
date_default_timezone_set('UTC');

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
