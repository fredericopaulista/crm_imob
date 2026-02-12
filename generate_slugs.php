<?php
require_once 'config.php';
require_once 'db.php';
require_once 'models/Property.php';

$property = new Property();
$properties = $property->getAll();

echo "🔄 Gerando slugs para imóveis existentes...\n\n";

$count = 0;
foreach ($properties as $prop) {
    // Force update all slugs to fix encoding issues
    $slug = $property->generateSlug($prop['title'], $prop['id']);
    $property->updateSlug($prop['id'], $slug);
    echo "✅ #{$prop['id']}: {$prop['title']} → /{$slug}\n";
    $count++;
}

echo "\n========================================\n";
echo "✅ {$count} slugs gerados com sucesso!\n";
echo "========================================\n";
