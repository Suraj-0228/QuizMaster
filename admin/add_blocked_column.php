<?php
require_once '../config/database.php';

try {
    echo "Checking users table schema...\n";
    
    // Check if column exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'is_blocked'");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Add column
        $sql = "ALTER TABLE users ADD COLUMN is_blocked TINYINT(1) DEFAULT 0 AFTER role";
        $pdo->exec($sql);
        echo "SUCCESS: Column 'is_blocked' added to 'users' table.\n";
    } else {
        echo "INFO: Column 'is_blocked' already exists.\n";
    }

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
