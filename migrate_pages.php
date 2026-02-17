<?php
require_once 'config.php';
require_once 'db.php';

$sql = file_get_contents('migration_pages.sql');
$db = Database::getInstance()->getConnection();

try {
    $db->exec($sql);
    echo "Migration successful!";
} catch (PDOException $e) {
    echo "Migration failed: " . $e->getMessage();
}
