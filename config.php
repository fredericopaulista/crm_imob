<?php

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'crm_imob');
define('DB_USER', 'root');
define('DB_PASS', '');

// App Configuration
define('APP_URL', 'http://localhost/crm_imob');
define('APP_NAME', 'ImobHub CRM');

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
