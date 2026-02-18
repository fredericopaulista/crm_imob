<?php
require_once 'config.php';
require_once 'db.php';

$sql = file_get_contents('migration_kanban.sql');
$db = Database::getInstance()->getConnection();

// Split SQL by semicolon safely-ish (simplified for this specific file)
// Since the file has multiple statements, we can't just exec() the whole string in some PDO drivers dependent on config.
// But usually $db->exec() supports multiple statements if emulation is on.
// Let's try one by one to be safer and catch errors.

$statements = array_filter(array_map('trim', explode(';', $sql)));

foreach ($statements as $stmt) {
    if (!empty($stmt)) {
        try {
            $db->exec($stmt);
            echo "Executed: " . substr($stmt, 0, 50) . "...\n";
        } catch (PDOException $e) {
            // Ignore "Duplicate column name" error if re-running
            if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
                 echo "Skipped (Column already exists): " . substr($stmt, 0, 50) . "...\n";
            } elseif (strpos($e->getMessage(), 'Table \'lead_stages\' already exists') !== false) {
                 echo "Skipped (Table already exists): " . substr($stmt, 0, 50) . "...\n";
            } else {
                echo "Error executing: " . $stmt . "\nError: " . $e->getMessage() . "\n";
            }
        }
    }
}
echo "Migration process finished.\n";
