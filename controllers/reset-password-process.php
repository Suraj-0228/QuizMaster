<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$errors = [];
$isValidToken = false;
$user_id = null;

// Require a token to even view the page
$token = isset($_GET['token']) ? $_GET['token'] : (isset($_POST['token']) ? $_POST['token'] : '');

if (empty($token)) {
    // Cannot reset if missing token
    flash('message', 'Invalid or missing password reset token.', 'danger');
    redirect('login.php');
    exit;
}

// Check database for token and validity
$stmt = $pdo->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expires_at > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch();

if ($user) {
    $isValidToken = true;
    $user_id = $user['id'];
} else {
    flash('message', 'This password reset link is invalid or has expired. Please request a new one.', 'danger');
    redirect('forgot-password.php');
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isValidToken) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    
    if (empty($errors)) {
        // Securely hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update user, and nullify the tokens so the link cannot be reused
        $update_stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?");
        
        if ($update_stmt->execute([$hashed_password, $user_id])) {
            flash('message', 'Your password has been successfully reset! You may now login.', 'success');
            redirect('login.php');
            exit;
        } else {
            $errors[] = "A system error occurred. Please try again.";
        }
    }
}

$pageTitle = 'Set New Password';
include_once 'includes/header.php';
?>
