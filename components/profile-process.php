<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$message = '';

// Handle POST Requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Change Password
    if (isset($_POST['update_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validation removed per user request
        // if (!empty($password))...
        
        // We assume JS checked for emptiness and matching
        // if ($password === $confirm_password) {
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($stmt->execute([$password, $user_id])) {
                flash('message', 'Password updated successfully!', 'success');
            } else {
                flash('message', 'Error updating password.', 'danger');
            }
        // } else { flash... }
    }
    
    // 2. Delete Account
    if (isset($_POST['delete_account'])) {
        $confirm_delete = $_POST['confirm_delete'];
        if ($confirm_delete === 'DELETE') {
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $pdo->commit();
                
                session_destroy();
                redirect('../login.php?msg=account_deleted');
            } catch (Exception $e) {
                $pdo->rollBack();
                flash('message', 'Error deleting account: ' . $e->getMessage(), 'danger');
            }
        } else {
            flash('message', 'Please type DELETE to confirm.', 'warning');
        }
    }
}

// Fetch User Data
$stmt = $pdo->prepare("SELECT username, email, role, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Stats
$quizzes_taken = $pdo->prepare("SELECT COUNT(*) FROM quiz_attempts WHERE user_id = ?");
$quizzes_taken->execute([$user_id]);
$stats_count = $quizzes_taken->fetchColumn();

// Avg Score
$avg_score_stmt = $pdo->prepare("SELECT AVG((score/total_questions)*100) FROM quiz_attempts WHERE user_id = ? AND total_questions > 0");
$avg_score_stmt->execute([$user_id]);
$avg_score = round((float)$avg_score_stmt->fetchColumn(), 1);

$pageTitle = 'My Profile';
include_once '../includes/header.php';
?>