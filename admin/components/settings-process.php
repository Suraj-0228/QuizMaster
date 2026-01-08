<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

$message = '';
$messageType = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = $_POST['site_name'];
    $maintenance_mode = isset($_POST['maintenance_mode']) ? '1' : '0';
    
    try {
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'site_name'");
        $stmt->execute([$site_name]);
        
        $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'maintenance_mode'");
        $stmt->execute([$maintenance_mode]);
        
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