<?php
// Organize permissions by module for display
$modules = [
    'Dashboard' => ['view_dashboard'],
    'Agenda' => ['view_appointments', 'create_appointments', 'edit_appointments', 'delete_appointments'],
    'Imóveis' => ['view_properties', 'create_properties', 'edit_properties', 'delete_properties'],
    'Clientes' => ['view_clients', 'create_clients', 'edit_clients', 'delete_clients'],
    'Leads' => ['view_leads', 'create_leads', 'edit_leads', 'delete_leads'],
    'Proprietários' => ['view_owners', 'create_owners', 'edit_owners', 'delete_owners'],
    'Propostas' => ['view_proposals', 'create_proposals', 'edit_proposals', 'delete_proposals'],
    'Marketing' => ['view_marketing', 'create_campaigns', 'edit_campaigns', 'delete_campaigns'],
    'WhatsApp' => ['view_chat', 'send_messages', 'configure_whatsapp'],
    'Blog' => ['view_blog', 'create_posts', 'edit_posts', 'delete_posts'],
    'Usuários' => ['view_users', 'create_users', 'edit_users', 'delete_users'],
    'Perfis' => ['view_roles', 'create_roles', 'edit_roles', 'delete_roles'],
    'Configurações' => ['view_settings', 'edit_settings'],
];

// Helper to find permission ID by slug
$getPermId = function($slug) use ($allPermissions) {
    foreach ($allPermissions as $p) {
        if ($p['slug'] === $slug) return $p['id'];
    }
    return null;
};

// Helper for label
$getLabel = function($slug) {
    if (strpos($slug, 'view_') === 0) return 'Ver';
    if (strpos($slug, 'create_') === 0) return 'Criar';
    if (strpos($slug, 'edit_') === 0) return 'Editar';
    if (strpos($slug, 'delete_') === 0) return 'Excluir';
    if ($slug === 'access_chat') return 'Acessar';
    if ($slug === 'send_messages') return 'Enviar';
    if ($slug === 'configure_whatsapp') return 'Configurar';
    return $slug;
};
?>

<div class="space-y-6">
    <?php foreach ($modules as $moduleName => $slugs): ?>
    <div class="border-b border-gray-100 pb-4 last:border-0">
        <h3 class="text-sm font-medium text-gray-900 mb-3"><?php echo $moduleName; ?></h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <?php foreach ($slugs as $slug): 
                $permId = $getPermId($slug);
                if (!$permId) continue; // Skip if permission doesn't exist in DB yet
                $isChecked = in_array($permId, $rolePermissions ?? []) ? 'checked' : '';
            ?>
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input id="perm_<?php echo $permId; ?>" name="permissions[]" value="<?php echo $permId; ?>" type="checkbox" <?php echo $isChecked; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                </div>
                <div class="ml-3 text-sm leading-6">
                    <label for="perm_<?php echo $permId; ?>" class="font-medium text-gray-900"><?php echo $getLabel($slug); ?></label>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="mt-4 flex gap-2">
    <button type="button" onclick="document.querySelectorAll('input[name=\'permissions[]\']').forEach(el => el.checked = true);" class="text-xs text-indigo-600 hover:text-indigo-800">Marcar Todos</button>
    <span class="text-gray-300">|</span>
    <button type="button" onclick="document.querySelectorAll('input[name=\'permissions[]\']').forEach(el => el.checked = false);" class="text-xs text-indigo-600 hover:text-indigo-800">Desmarcar Todos</button>
</div>
