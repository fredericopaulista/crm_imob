<?php
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔄 Executando migração SEO...\n\n";
    
    // Check if slug column already exists
    $checkSlug = $conn->query("SHOW COLUMNS FROM `properties` LIKE 'slug'");
    if ($checkSlug->rowCount() == 0) {
        echo "➕ Adicionando coluna 'slug' na tabela properties...\n";
        $conn->exec("ALTER TABLE `properties` ADD COLUMN `slug` VARCHAR(255) DEFAULT NULL AFTER `title`");
        $conn->exec("ALTER TABLE `properties` ADD UNIQUE KEY `slug` (`slug`)");
        echo "✅ Coluna 'slug' adicionada com sucesso!\n\n";
    } else {
        echo "ℹ️  Coluna 'slug' já existe.\n\n";
    }
    
    // Add indexes if they don't exist
    try {
        $conn->exec("ALTER TABLE `properties` ADD KEY `idx_status` (`status`)");
        echo "✅ Índice idx_status adicionado!\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
            echo "ℹ️  Índice idx_status já existe.\n";
        } else {
            throw $e;
        }
    }
    
    try {
        $conn->exec("ALTER TABLE `properties` ADD KEY `idx_purpose` (`purpose`)");
        echo "✅ Índice idx_purpose adicionado!\n\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
            echo "ℹ️  Índice idx_purpose já existe.\n\n";
        } else {
            throw $e;
        }
    }
    
    // Create settings table
    $checkSettings = $conn->query("SHOW TABLES LIKE 'settings'");
    if ($checkSettings->rowCount() == 0) {
        echo "➕ Criando tabela 'settings'...\n";
        $conn->exec("
            CREATE TABLE `settings` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `setting_key` VARCHAR(100) NOT NULL,
              `setting_value` TEXT DEFAULT NULL,
              `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              UNIQUE KEY `setting_key` (`setting_key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        echo "✅ Tabela 'settings' criada com sucesso!\n\n";
        
        // Insert default settings
        echo "➕ Inserindo configurações padrão...\n";
        $defaults = [
            ['google_search_console', ''],
            ['google_analytics', ''],
            ['sitemap_generated_at', null],
            ['robots_generated_at', null]
        ];
        
        $stmt = $conn->prepare("INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES (?, ?)");
        foreach ($defaults as $setting) {
            $stmt->execute($setting);
        }
        echo "✅ Configurações padrão inseridas!\n\n";
    } else {
        echo "ℹ️  Tabela 'settings' já existe.\n\n";
    }
    
    echo "========================================\n";
    echo "✅ MIGRAÇÃO CONCLUÍDA COM SUCESSO!\n";
    echo "========================================\n";
    
} catch(PDOException $e) {
    echo "❌ Erro na migração: " . $e->getMessage() . "\n";
    exit(1);
}
