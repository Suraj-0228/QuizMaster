<?php
require_once 'config/database.php';

echo "Starting password migration...\n";

try {
    // 1. Fetch all users
    $stmt = $pdo->query("SELECT id, username, password FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count = 0;
    foreach ($users as $user) {
        $id = $user['id'];
        $plain_password = $user['password'];

        // Check if already hashed (basic check for bcrypt/argon2 signature)
        if (password_get_info($plain_password)['algoName'] !== 'unknown') {
            echo "User {$user['username']} already has a hashed password. Skipping.\n";
            continue;
        }

        // 2. Hash the password
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // 3. Update the database
        $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->execute([$hashed_password, $id]);

        $count++;
        echo "Updated password for user: {$user['username']}\n";
    }

    echo "Migration completed. Updated $count users.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
