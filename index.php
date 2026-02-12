<?php
require_once 'config.php';
require_once 'db.php';
require_once 'helpers.php';
// Security Headers
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: default-src 'self' https:; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://ui-avatars.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https://ui-avatars.com; connect-src 'self' https://graph.facebook.com;");

// Autoload helper
spl_autoload_register(function ($class_name) {
    if (file_exists('controllers/' . $class_name . '.php')) {
        require_once 'controllers/' . $class_name . '.php';
    } elseif (file_exists('models/' . $class_name . '.php')) {
        require_once 'models/' . $class_name . '.php';
    }
});

// Parse URL
if (isset($_GET['url'])) {
    $request = '/' . $_GET['url'];
} elseif (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '/') {
    $request = $_SERVER['PATH_INFO'];
} else {
    $request = $_SERVER['REQUEST_URI'];
    // Remove subdirectory if exists (e.g. /crm_imob)
    $basePath = parse_url(APP_URL, PHP_URL_PATH);
    if ($basePath && $basePath !== '/') {
        $request = str_replace($basePath, '', $request);
    }
    $request = explode('?', $request)[0];
}

$request = rtrim($request, '/');
if ($request === '') $request = '/';

// PT-BR Route Map
$routes = [
        // --- PUBLIC ROUTES ---
    '/' => 'SiteController@index',
    '/imoveis' => 'SiteController@catalog',
    '/imovel' => 'SiteController@detail', // regex handled below for slugs
    '/contato' => 'SiteController@contact',
    '/enviar-contato' => 'SiteController@sendContact',

    // --- ADMIN ROUTES (/painel) ---
    // Dashboard
    '/painel' => 'DashboardController@index',
    '/dashboard' => 'DashboardController@index', // legacy support

    // Properties (Imóveis)
    '/painel/imoveis' => 'PropertyController@index',
    '/painel/imoveis/novo' => 'PropertyController@create',
    '/painel/imoveis/salvar' => 'PropertyController@store',
    '/painel/imoveis/editar' => 'PropertyController@edit',
    '/painel/imoveis/atualizar' => 'PropertyController@update',
    '/painel/imoveis/excluir' => 'PropertyController@delete',

    // Clients (Clientes)
    '/painel/clientes' => 'ClientController@index',
    '/painel/clientes/novo' => 'ClientController@create',
    '/painel/clientes/salvar' => 'ClientController@store',
    '/painel/clientes/editar' => 'ClientController@edit',
    '/painel/clientes/atualizar' => 'ClientController@update',
    '/painel/clientes/excluir' => 'ClientController@delete',

    // Leads
    '/painel/leads' => 'LeadController@index',
    '/painel/leads/novo' => 'LeadController@create',
    '/painel/leads/salvar' => 'LeadController@store',
    '/painel/leads/editar' => 'LeadController@edit',
    '/painel/leads/atualizar' => 'LeadController@update',
    '/painel/leads/excluir' => 'LeadController@delete',
    '/painel/leads/converter' => 'LeadController@convert',

    // Proprietários (Owners)
    '/painel/proprietarios' => 'OwnerController@index',
    '/painel/proprietarios/novo' => 'OwnerController@create',
    '/painel/proprietarios/salvar' => 'OwnerController@store',
    '/painel/proprietarios/editar' => 'OwnerController@edit',
    '/painel/proprietarios/atualizar' => 'OwnerController@update',
    '/painel/proprietarios/excluir' => 'OwnerController@delete',


    // Proposals (Propostas)
    '/painel/propostas' => 'ProposalController@index',
    '/painel/propostas/novo' => 'ProposalController@create',
    '/painel/propostas/salvar' => 'ProposalController@store',
    '/painel/propostas/editar' => 'ProposalController@edit',
    '/painel/propostas/atualizar' => 'ProposalController@update',
    '/painel/propostas/excluir' => 'ProposalController@delete',
    '/painel/propostas/pdf' => 'ProposalController@pdf',

    // Marketing
    '/painel/marketing' => 'CampaignController@index',
    '/painel/marketing/importar' => 'CampaignController@import',
    '/painel/marketing/processar-importacao' => 'CampaignController@processImport',
    '/painel/marketing/disparo' => 'CampaignController@broadcast',
    '/painel/marketing/enviar-disparo' => 'CampaignController@sendBroadcast',
    '/painel/marketing/filtrar-tag' => 'CampaignController@getClientsByTag',
    '/painel/marketing/configuracoes' => 'CampaignController@settings',
    '/painel/marketing/salvar-configuracoes' => 'CampaignController@updateSettings',
    
    // Users
    '/painel/usuarios' => 'UserController@index',
    '/painel/usuarios/novo' => 'UserController@create',
    '/painel/usuarios/salvar' => 'UserController@store',
    '/painel/usuarios/editar' => 'UserController@edit',
    '/painel/usuarios/atualizar' => 'UserController@update',
    '/painel/usuarios/excluir' => 'UserController@delete',
    
    // Roles (Perfis)
    '/painel/perfis' => 'RoleController@index',
    '/painel/perfis/novo' => 'RoleController@create',
    '/painel/perfis/salvar' => 'RoleController@store',
    '/painel/perfis/editar' => 'RoleController@edit',
    '/painel/perfis/atualizar' => 'RoleController@update',
    '/painel/perfis/excluir' => 'RoleController@delete',
    
    // Settings (Configurações)
    '/painel/configuracoes' => 'SettingsController@index',
    '/painel/configuracoes/atualizar' => 'SettingsController@update',
    '/painel/configuracoes/sitemap' => 'SettingsController@generateSitemap',
    '/painel/configuracoes/robots' => 'SettingsController@generateRobots',
    '/painel/configuracoes/sitemap/download' => 'SettingsController@downloadSitemap',
    '/painel/configuracoes/robots/download' => 'SettingsController@downloadRobots',
    
    // Auth (Keep as is, or move to /painel/login?) - Keeping /acesso for now
    '/acesso/login' => 'AuthController@login',
    '/acesso/autenticar' => 'AuthController@authenticate',
    '/acesso/sair' => 'AuthController@logout',
    
    // WhatsApp
    '/painel/whatsapp' => 'ChatController@index',
    '/painel/whatsapp/conversas' => 'ChatController@getConversations',
    '/painel/whatsapp/mensagens' => 'ChatController@getMessages',
    '/painel/whatsapp/enviar' => 'ChatController@sendMessage',
    '/whatsapp/webhook' => 'ChatController@webhook', // Keep public for webhook
];

// Check if route exists
if (array_key_exists($request, $routes)) {
    $route = $routes[$request];
    list($controllerName, $method) = explode('@', $route);
} elseif (preg_match('#^/imovel/([a-z0-9-]+)$#', $request, $matches)) {
    // Regex match for /imovel/{slug} or /imovel/{id}
    if (is_numeric($matches[1])) {
        $_GET['id'] = $matches[1];
    } else {
        $_GET['slug'] = $matches[1];
    }
    $controllerName = 'SiteController';
    $method = 'detail';
} else {
    http_response_code(404);
    echo "Página não encontrada ($request)";
    exit;
}


// Auth Check
// Public routes don't require authentication
$publicControllers = ['AuthController', 'SiteController'];
$publicMethods = ['webhook'];

if (!in_array($controllerName, $publicControllers) && !in_array($method, $publicMethods) && !isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . '/acesso/login');
    exit;
}

if (file_exists('controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        http_response_code(404);
        echo "Método não encontrado";
    }
} else {
    http_response_code(404);
    echo "Controller não encontrado";
}
