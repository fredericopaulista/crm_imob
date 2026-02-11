<?php
require_once 'config.php';
require_once 'db.php';
require_once 'helpers.php';

// Autoload helper (Simple)
spl_autoload_register(function ($class_name) {
    if (file_exists('controllers/' . $class_name . '.php')) {
        require_once 'controllers/' . $class_name . '.php';
    } elseif (file_exists('models/' . $class_name . '.php')) {
        require_once 'models/' . $class_name . '.php';
    }
});

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard'; // Default to dashboard
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$method = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Auth Check (Except for login/auth routes)
if ($controllerName !== 'AuthController' && !isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . '/auth/login');
    exit;
}

// Routing
if (file_exists('controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        // 404 Method not found
        echo "404 - Method '$method' not found in '$controllerName'";
    }
} else {
    // 404 Controller not found OR Default invalid route
    // If it's 'DashboardController' and it doesn't exist yet, we might want to handle it.
    // For now, simple 404.
    if ($url[0] == 'dashboard') {
         // Redirect to dashboard controller if it exists, logic handled above.
         // If file doesn't exist:
         echo "Dashboard Controller not created yet.";
    } else {
         echo "404 - Controller '$controllerName' not found";
    }
}
