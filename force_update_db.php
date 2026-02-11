<?php
require_once 'config.php';
require_once 'db.php';

try {
    $pdo = Database::getInstance()->getConnection();
    echo "Iniciando verificação de tabelas...\n<br>";

    // 1. Settings Table
    $sql = "CREATE TABLE IF NOT EXISTS `settings` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `key_name` varchar(50) NOT NULL,
      `value` text DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `key_name` (`key_name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($sql);
    echo "Tabela 'settings' verificada/criada.\n<br>";
    
    // Seed default settings
    $pdo->exec("INSERT IGNORE INTO `settings` (`key_name`, `value`) VALUES ('business_hours_start', '08:00'), ('business_hours_end', '18:00')");
    echo "Configurações padrão inseridas.\n<br>";

    // 2. Tags Table
    $sql = "CREATE TABLE IF NOT EXISTS `tags` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(50) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `name` (`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($sql);
    echo "Tabela 'tags' verificada/criada.\n<br>";

    // 3. Client Tags Pivot Table
    $sql = "CREATE TABLE IF NOT EXISTS `client_tags` (
      `client_id` int(11) NOT NULL,
      `tag_id` int(11) NOT NULL,
      PRIMARY KEY (`client_id`,`tag_id`),
      KEY `tag_id` (`tag_id`),
      CONSTRAINT `client_tags_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
      CONSTRAINT `client_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($sql);
    echo "Tabela 'client_tags' verificada/criada.\n<br>";
    
    // 4. Broadcasts Table (Optional but good to have)
    $sql = "CREATE TABLE IF NOT EXISTS `broadcasts` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `message` text NOT NULL,
      `recipient_count` int(11) DEFAULT 0,
      `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `broadcasts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($sql);
    echo "Tabela 'broadcasts' verificada/criada.\n<br>";
    
    // 5. Ensure Permission manage_marketing exists
    $stmt = $pdo->prepare("SELECT id FROM permissions WHERE slug = 'manage_marketing'");
    $stmt->execute();
    if (!$stmt->fetch()) {
        $pdo->exec("INSERT INTO permissions (name, slug, description) VALUES ('Gerenciar Marketing', 'manage_marketing', 'Permite importar contatos e enviar disparos')");
        $permId = $pdo->lastInsertId();
        // Give to Admin (assumption: id 1)
        $pdo->exec("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (1, $permId)");
        echo "Permissão 'manage_marketing' criada e atribuída ao Admin.\n<br>";
    }

    echo "Tudo pronto! Você pode apagar este arquivo agora.\n";

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
