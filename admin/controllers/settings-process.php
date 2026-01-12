<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

$message = '';
$messageType = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings_to_update = [
        'site_name' => $_POST['site_name'] ?? 'QuizMaster',
        'site_description' => $_POST['site_description'] ?? '',
        'contact_email' => $_POST['contact_email'] ?? '',
        'items_per_page' => $_POST['items_per_page'] ?? '10',
        'maintenance_mode' => isset($_POST['maintenance_mode']) ? '1' : '0',
        'allow_registration' => isset($_POST['allow_registration']) ? '1' : '0'
    ];
    
    try {
        $pdo->beginTransaction();
        
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM settings WHERE setting_key = ?");
        $stmt_insert = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)");
        $stmt_update = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");

        foreach ($settings_to_update as $key => $value) {
            // Check if key exists
            $stmt_check->execute([$key]);
            if ($stmt_check->fetchColumn() == 0) {
                // Insert if not exists
                $stmt_insert->execute([$key, $value]);
            } else {
                // Update if exists
                $stmt_update->execute([$value, $key]);
            }
        }
        
        $pdo->commit();
        $message = 'Settings updated successfully.';
        $messageType = 'success';
    } catch (Exception $e) {
        $pdo->rollBack();
        $message = 'Error updating settings: ' . $e->getMessage();
        $messageType = 'danger';
    }
}

// Fetch Current Settings
$settings = [];
$stmt = $pdo->query("SELECT * FROM settings");
while ($row = $stmt->fetch()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$pageTitle = 'Site Settings';
include_once '../includes/header.php';
?>