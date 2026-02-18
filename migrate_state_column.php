<?php
require_once 'config.php';
require_once 'db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Read SQL file
    $sql = file_get_contents('migration_add_state_to_properties.sql');

    // Execute migration
    $conn->exec($sql);

    echo "✅ Migration successful: 'state' column added to 'properties' table.\n";

} catch (PDOException $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    // Check if column already exists
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "ℹ️ Column 'state' likely already exists.\n";
    }
}
