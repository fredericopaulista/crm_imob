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
$request = $_SERVER['REQUEST_URI'];
// Remove subdirectory if exists (e.g. /crm_imob)
$basePath = parse_url(APP_URL, PHP_URL_PATH);
if ($basePath && $basePath !== '/') {
    $request = str_replace($basePath, '', $request);
}

$request = explode('?', $request)[0];
$request = rtrim($request, '/');
if ($request === '') $request = '/';

// PT-BR Route Map
$routes = [
    // Dashboard
    '/' => 'DashboardController@index',
    '/painel' => 'DashboardController@index',
    '/dashboard' => 'DashboardController@index', // fallback

    // Properties (Imóveis)
    '/imoveis' => 'PropertyController@index',
    '/imoveis/novo' => 'PropertyController@create',
    '/imoveis/salvar' => 'PropertyController@store',
    '/imoveis/editar' => 'PropertyController@edit',
    '/imoveis/atualizar' => 'PropertyController@update',
    '/imoveis/excluir' => 'PropertyController@delete',

    // Clients (Clientes)
    '/clientes' => 'ClientController@index',
    '/clientes/novo' => 'ClientController@create',
    '/clientes/salvar' => 'ClientController@store',
    '/clientes/editar' => 'ClientController@edit',
    '/clientes/atualizar' => 'ClientController@update',
    '/clientes/excluir' => 'ClientController@delete',

    // Proposals (Propostas)
    '/propostas' => 'ProposalController@index',
    '/propostas/novo' => 'ProposalController@create',
    '/propostas/salvar' => 'ProposalController@store',
    '/propostas/editar' => 'ProposalController@edit',
    '/propostas/atualizar' => 'ProposalController@update',
    '/propostas/excluir' => 'ProposalController@delete',
    '/propostas/pdf' => 'ProposalController@pdf',

    // Marketing
    '/marketing' => 'CampaignController@index',
    '/marketing/importar' => 'CampaignController@import',
    '/marketing/processar-importacao' => 'CampaignController@processImport',
    '/marketing/disparo' => 'CampaignController@broadcast',
    '/marketing/enviar-disparo' => 'CampaignController@sendBroadcast',
    '/marketing/filtrar-tag' => 'CampaignController@getClientsByTag',
    '/marketing/configuracoes' => 'CampaignController@settings',
    '/marketing/salvar-configuracoes' => 'CampaignController@updateSettings',
    
    // Users
    '/usuarios' => 'UserController@index',
    '/usuarios/novo' => 'UserController@create',
    '/usuarios/salvar' => 'UserController@store',
    '/usuarios/editar' => 'UserController@edit',
    '/usuarios/atualizar' => 'UserController@update',
    '/usuarios/excluir' => 'UserController@delete',
    
    // Roles (Perfis)
    '/perfis' => 'RoleController@index',
    '/perfis/novo' => 'RoleController@create',
    '/perfis/salvar' => 'RoleController@store',
    '/perfis/editar' => 'RoleController@edit',
    '/perfis/atualizar' => 'RoleController@update',
    '/perfis/excluir' => 'RoleController@delete',
    
    // Auth
    '/acesso/login' => 'AuthController@login',
    '/acesso/autenticar' => 'AuthController@authenticate',
    '/acesso/sair' => 'AuthController@logout',
    
    // WhatsApp
    '/whatsapp' => 'ChatController@index',
    '/whatsapp/conversas' => 'ChatController@getConversations',
    '/whatsapp/mensagens' => 'ChatController@getMessages',
    '/whatsapp/enviar' => 'ChatController@sendMessage',
    '/whatsapp/webhook' => 'ChatController@webhook',
];

// Fallback logic for legacy routes (optional) if not found in map
if (!array_key_exists($request, $routes)) {
    // Try dynamic matching ONLY for IDs if needed (e.g. /imoveis/editar?id=1 uses query param, so exact match works)
    // If we used /imoveis/1/editar, we'd need regex.
    // Confirming usage: The system uses query params logic mostly.
    
    http_response_code(404);
    echo "404 - Página não encontrada ($request)";
    exit;
}

$route = $routes[$request];
list($controllerName, $method) = explode('@', $route);

// Auth Check
if ($controllerName !== 'AuthController' && $method !== 'webhook' && !isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . '/acesso/login');
    exit;
}

if (file_exists('controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        call_user_func([$controller, $method]);
    } else {
        echo "404 - Method '$method' not found";
    }
} else {
    echo "404 - Controller '$controllerName' not found";
}
