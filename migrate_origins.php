<?php
require_once 'config.php';
require_once 'db.php';

$sql = file_get_contents('migration_origins.sql');
$db = Database::getInstance()->getConnection();

$statements = array_filter(array_map('trim', explode(';', $sql)));

foreach ($statements as $stmt) {
    if (!empty($stmt)) {
        try {
            $db->exec($stmt);
            echo "Executed: " . substr($stmt, 0, 50) . "...\n";
        } catch (PDOException $e) {
            // Ignore common "already exists" errors for idempotency
            if (strpos($e->getMessage(), 'Duplicate column name') !== false || 
                strpos($e->getMessage(), 'Table \'lead_origins\' already exists') !== false) {
                 echo "Skipped (Already exists): " . substr($stmt, 0, 50) . "...\n";
            } else {
                echo "Error executing: " . $stmt . "\nError: " . $e->getMessage() . "\n";
            }
        }
    }
}
echo "Migration process finished.\n";
