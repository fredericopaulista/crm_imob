<?php
// Quick script to update property links in views to use slugs

$files = [
    'views/site/home.php',
    'views/site/catalog.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace property ID links with slug links (with fallback to ID)
    $content = str_replace(
        "/imovel/<?php echo \$property['id']; ?>",
        "/imovel/<?php echo \$property['slug'] ?? \$property['id']; ?>",
        $content
    );
    
    file_put_contents($file, $content);
    echo "✅ Updated: $file\n";
}

echo "\n✅ All views updated to use slugs!\n";
