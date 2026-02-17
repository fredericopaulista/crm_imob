<?php
require_once 'config.php';
require_once 'db.php';

try {
    $db = Database::getInstance()->getConnection();
    $sql = file_get_contents('migration_blog.sql');
    
    // Split by semicolon to handle multiple statements if any (though here it's just one table creation usually)
    // But basic exec might work for single statement
    $db->exec($sql);
    
    echo "Migration executed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
