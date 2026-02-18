<?php
require_once 'config.php';
require_once 'db.php';

echo "Iniciando migração de permissões para granular (V2)...\n";

$conn = Database::getInstance()->getConnection();

// 1. Definir novas permissões
$modules = [
    'Dashboard' => ['view_dashboard' => 'Ver Dashboard'],
    'Imóveis' => [
        'view_properties' => 'Ver Imóveis',
        'create_properties' => 'Criar Imóveis',
        'edit_properties' => 'Editar Imóveis',
        'delete_properties' => 'Excluir Imóveis'
    ],
    'Clientes' => [
        'view_clients' => 'Ver Clientes',
        'create_clients' => 'Criar Clientes',
        'edit_clients' => 'Editar Clientes',
        'delete_clients' => 'Excluir Clientes'
    ],
    'Leads' => [
        'view_leads' => 'Ver Leads',
        'create_leads' => 'Criar Leads',
        'edit_leads' => 'Editar Leads',
        'delete_leads' => 'Excluir Leads'
    ],
    'Propostas' => [
        'view_proposals' => 'Ver Propostas',
        'create_proposals' => 'Criar Propostas',
        'edit_proposals' => 'Editar Propostas',
        'delete_proposals' => 'Excluir Propostas'
    ],
    'Agenda' => [
        'view_appointments' => 'Ver Agenda',
        'create_appointments' => 'Criar Agendamentos',
        'edit_appointments' => 'Editar Agendamentos',
        'delete_appointments' => 'Excluir Agendamentos'
    ],
    'Proprietários' => [
        'view_owners' => 'Ver Proprietários',
        'create_owners' => 'Criar Proprietários',
        'edit_owners' => 'Editar Proprietários',
        'delete_owners' => 'Excluir Proprietários'
    ],
    'Marketing' => [
        'view_marketing' => 'Ver Marketing',
        'create_campaigns' => 'Criar Campanhas',
        'edit_campaigns' => 'Editar Campanhas',
        'delete_campaigns' => 'Excluir Campanhas'
    ],
    'WhatsApp' => [
        'view_chat' => 'Acessar Chat',
        'send_messages' => 'Enviar Mensagens',
        'configure_whatsapp' => 'Configurar API'
    ],
    'Blog' => [
        'view_blog' => 'Ver Blog',
        'create_posts' => 'Criar Posts',
        'edit_posts' => 'Editar Posts',
        'delete_posts' => 'Excluir Posts'
    ],
    'Usuários' => [
        'view_users' => 'Ver Usuários',
        'create_users' => 'Criar Usuários',
        'edit_users' => 'Editar Usuários',
        'delete_users' => 'Excluir Usuários'
    ],
    'Perfis' => [
        'view_roles' => 'Ver Perfis',
        'create_roles' => 'Criar Perfis',
        'edit_roles' => 'Editar Perfis',
        'delete_roles' => 'Excluir Perfis'
    ],
    'Configurações' => [
        'view_settings' => 'Ver Configurações',
        'edit_settings' => 'Editar Configurações'
    ]
];

// Opcional: Limpar tabela de permissões antigas?
// Vamos manter e adicionar as novas, depois remover as duplas ou antigas se quiser.
// Melhor: Truncate e re-inserir. MAS precisamos salvar quem tem o que.
// Como os slugs vão mudar, o mapeamento automático é difícil.
// Simplificação: Dar TODAS as permissões para o Admin.
// E para outros perfis, vamos ter que reconfigurar manualmente ou tentar adivinhar.

$conn->exec("SET FOREIGN_KEY_CHECKS = 0");
$conn->exec("TRUNCATE TABLE role_permissions");
$conn->exec("TRUNCATE TABLE permissions");
$conn->exec("SET FOREIGN_KEY_CHECKS = 1");

echo "Tabela de permissões limpa.\n";

$stmt = $conn->prepare("INSERT INTO permissions (name, slug, description) VALUES (:name, :slug, :description)");

foreach ($modules as $moduleName => $perms) {
    foreach ($perms as $slug => $name) {
        $stmt->execute([
            ':name' => $name,
            ':slug' => $slug,
            ':description' => "Permite {$name} no módulo {$moduleName}"
        ]);
        echo "Permissão criada: {$name} ({$slug})\n";
    }
}

// 2. Restaurar permissões do Admin (ID 1)
// Admin ganha TUDO.
echo "Restaurando permissões do Admin...\n";
$stmt = $conn->query("SELECT id FROM permissions");
$allPermissionIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (1, :permission_id)");
foreach ($allPermissionIds as $permId) {
    $stmt->execute([':permission_id' => $permId]);
}

echo "Admin restaurado com acesso total.\n";

// 3. (Opcional) Restaurar 'Corretor' (ID 2) com permissões básicas
// Vamos dar acesso a Imóveis, Clientes, Leads, Propostas, Agenda, WhatsApp (básico)
echo "Configurando perfil Corretor (Básico)...\n";
$corretorPermsSlugs = [
    'view_properties', 'create_properties', 'edit_properties', // Sem delete
    'view_clients', 'create_clients', 'edit_clients',
    'view_leads', 'create_leads', 'edit_leads',
    'view_proposals', 'create_proposals', 'edit_proposals',
    'view_appointments', 'create_appointments', 'edit_appointments',
    'view_owners',
    'view_chat', 'send_messages'
];

// Buscar IDs desses slugs
$inClause = implode("','", $corretorPermsSlugs);
$stmt = $conn->query("SELECT id FROM permissions WHERE slug IN ('$inClause')");
$corretorPermIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $conn->prepare("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (2, :permission_id)");
foreach ($corretorPermIds as $permId) {
    $stmt->execute([':permission_id' => $permId]);
}

echo "Perfil Corretor configurado.\n";
echo "Migração concluída com sucesso!\n";
