<?php
require_once 'config.php';
require_once 'db.php';

try {
    $conn = Database::getInstance()->getConnection();
    
    // Check if column exists
    $check = $conn->query("SHOW COLUMNS FROM properties LIKE 'external_id'");
    if ($check->rowCount() == 0) {
        $sql = "ALTER TABLE properties ADD COLUMN external_id VARCHAR(255) NULL AFTER id";
        $conn->exec($sql);
        echo "Column 'external_id' added successfully.\n";
        
        $sqlIndex = "ALTER TABLE properties ADD INDEX idx_external_id (external_id)";
        $conn->exec($sqlIndex);
        echo "Index on 'external_id' added successfully.\n";
    } else {
        echo "Column 'external_id' already exists.\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
