<?php
require_once 'config.php';

echo "<h1>Debug Routing</h1>";
echo "<pre>";
echo "APP_URL: " . APP_URL . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "QUERY_STRING: " . $_SERVER['QUERY_STRING'] . "\n";

// Emulate index.php logic
$request = $_SERVER['REQUEST_URI'];
$basePath = parse_url(APP_URL, PHP_URL_PATH);
if ($basePath && $basePath !== '/') {
    $request = str_replace($basePath, '', $request);
}
$request = explode('?', $request)[0];
$request = rtrim($request, '/');
if ($request === '') $request = '/';

echo "Parsed Request: " . $request . "\n";

if (preg_match('#^/imovel/([a-z0-9-]+)$#', $request, $matches)) {
    echo "✅ MATCHED ROUTE: /imovel/{slug}\n";
    print_r($matches);
} else {
    echo "❌ NO MATCH for /imovel/{slug}\n";
    echo "Regex used: #^/imovel/([a-z0-9-]+)$#\n";
}

echo "\n_GET content:\n";
print_r($_GET);

echo "\n_SERVER content:\n";
print_r($_SERVER);
echo "</pre>";
