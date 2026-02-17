<?php
require_once 'config.php';
require_once 'db.php';

try {
    $db = Database::getInstance()->getConnection();
    $sql = file_get_contents('migration_users_author.sql');
    $db->exec($sql);
    echo "Migration executed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
