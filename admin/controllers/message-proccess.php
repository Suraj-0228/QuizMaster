<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

$message = '';
$messageType = '';

// Handle Delete Action
if (isset($_POST['delete_message'])) {
    $msg_id = filter_var($_POST['message_id'], FILTER_VALIDATE_INT);
    if ($msg_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
            if ($stmt->execute([$msg_id])) {
                $message = "Message deleted successfully.";
                $messageType = "success";
            } else {
                $message = "Failed to delete message.";
                $messageType = "danger";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
            $messageType = "danger";
        }
    }
}

// Search & Pagination Logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = (int)getSetting('items_per_page', 10);
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build Query
$where_clause = "";
$params = [];
if (!empty($search)) {
    $where_clause = "WHERE name LIKE ? OR email LIKE ? OR subject LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Count Total for Pagination
$stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages $where_clause");
$stmt->execute($params);
$total_messages = $stmt->fetchColumn();
$total_pages = ceil($total_messages / $limit);

// Fetch Messages
$sql = "SELECT * FROM contact_messages $where_clause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$messages = $stmt->fetchAll();

// Stats (Simple counts)
$stmt_today = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE DATE(created_at) = CURDATE()");
$today_count = $stmt_today->fetchColumn();

$pageTitle = 'Messages';
include_once '../includes/header.php';
?>
