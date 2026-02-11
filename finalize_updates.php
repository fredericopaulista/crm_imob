<?php
// Quick script to add settings menu link and update regex

// 1. Add settings link to admin menu
$headerFile = 'views/layout/header.php';
$headerContent = file_get_contents($headerFile);

// Find the users menu item and add settings after it
$searchPattern = '<?php if (can(\'manage_roles\')): ?>';
$settingsLink = '                                <a href="<?php echo APP_URL; ?>/painel/configuracoes" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-400 hover:bg-gray-800 hover:text-white">
                                    <i class="fas fa-cog h-6 w-6 shrink-0 flex items-center justify-center"></i>
                                    Configurações SEO
                                </a>
                                
                                ';

if (strpos($headerContent, 'Configurações SEO') === false) {
    $headerContent = str_replace($searchPattern, $settingsLink . $searchPattern, $headerContent);
    file_put_contents($headerFile, $headerContent);
    echo "✅ Added settings link to admin menu\n";
} else {
    echo "ℹ️  Settings link already exists\n";
}

// 2. Update regex in index.php to match slugs
$indexFile = 'index.php';
$indexContent = file_get_contents($indexFile);

$oldRegex = "} elseif (preg_match('#^/imovel/(\\d+)\$#', \$request, \$matches)) {
    // Regex match for /imovel/{id}
    \$_GET['id'] = \$matches[1];";

$newRegex = "} elseif (preg_match('#^/imovel/([a-z0-9-]+)\$#', \$request, \$matches)) {
    // Regex match for /imovel/{slug} or /imovel/{id}
    if (is_numeric(\$matches[1])) {
        \$_GET['id'] = \$matches[1];
    } else {
        \$_GET['slug'] = \$matches[1];
    }";

if (strpos($indexContent, 'Regex match for /imovel/{slug}') === false) {
    $indexContent = str_replace($oldRegex, $newRegex, $indexContent);
    file_put_contents($indexFile, $indexContent);
    echo "✅ Updated regex to match slugs\n";
} else {
    echo "ℹ️  Regex already updated\n";
}

echo "\n✅ All updates completed!\n";
