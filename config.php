<?php

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'corret_ban');
define('DB_USER', 'corret_seen');
define('DB_PASS', '4RmR@dy[*_;s!]n[Dk');

// App Configuration
define('APP_URL', 'https://corretapro.com.br');
define('APP_NAME', 'Correta Pro');

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Error Reporting (Disable for production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
