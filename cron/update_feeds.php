<?php
// Set headers to prevent CLI output issues if run via browser (though intended for CLI)
if (php_sapi_name() !== 'cli') {
    die('Acesso restrito a linha de comando.');
}

// Define paths
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config.php';
require_once BASE_PATH . '/db.php';
require_once BASE_PATH . '/models/Property.php';
require_once BASE_PATH . '/controllers/PortalsController.php';

// Mock $_SERVER for APP_URL to work in CLI context if needed
// Although APP_URL usage in PortalsController depends on constants defined in config.php.
// If config.php uses $_SERVER['HTTP_HOST'], it might fail in CLI.
// Let's ensure APP_URL is defined or fallback.

echo "Iniciando atualizacao de feeds...\n";

try {
    // Instantiate Controller to reuse logic (bad practice but pragmatic here to avoid code Duplication)
    // Actually, PortalsController echoes content. We need to capture output.
    
    // Better approach: Extract generation logic to a Service or Model, but given constraints:
    // We will use output buffering.
    
    $controller = new PortalsController();
    
    // --- Generate Zap Feed ---
    ob_start();
    $controller->feedZap();
    $xmlContent = ob_get_clean();
    
    $filePath = BASE_PATH . '/assets/feeds/zap.xml';
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }
    
    if (file_put_contents($filePath, $xmlContent)) {
        echo "Feed Zap atualizado com sucesso: $filePath\n";
    } else {
        echo "Erro ao salvar Feed Zap.\n";
    }

    // --- Generate OLX Feed ---
    ob_start();
    $controller->feedOlx();
    $xmlContent = ob_get_clean();
    
    $filePath = BASE_PATH . '/assets/feeds/olx.xml';
    if (file_put_contents($filePath, $xmlContent)) {
        echo "Feed OLX atualizado com sucesso: $filePath\n";
    } else {
        echo "Erro ao salvar Feed OLX.\n";
    }

    echo "Concluido.\n";

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
