<?php

// Database Configuration
define('DB_HOST', '177.136.234.91');
define('DB_NAME', 'corret_ban');
define('DB_USER', 'corret_seen');
define('DB_PASS', '4RmR@dy[*_;s!]n[Dk');
define('DB_CHARSET', 'utf8mb4');

// App Configuration
define('APP_URL', 'https://corretapro.com.br');
define('APP_NAME', 'Correta Pro');

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Error Reporting (Disable for production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', 1); // Ensure usage over HTTPS

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
