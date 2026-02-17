<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        redirect('admin/dashboard.php');
    } else {
        redirect('student/dashboard.php');
    }
}

$error = '';
if (isset($_GET['error']) && $_GET['error'] === 'session_expired') {
    $error = "Your session has expired or the database was reset. Please login again.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $user = null; // Initialize
    // if (empty($email) || empty($password)) { $error = ... } REMOVED per user request
    
    // Proceed directly to DB check
    {
        // Check for blocked status
        $stmt = $pdo->prepare("SELECT id, username, password, role, is_blocked FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            
            // Check if blocked
            if (isset($user['is_blocked']) && $user['is_blocked'] == 1) {
                $error = "Your account has been suspended by the administrator.";
            } else {
                // Login success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    redirect('admin/dashboard.php');
                } else {
                    redirect('student/dashboard.php');
                }
            }
        } else {
            $error = "Invalid credentials";
        }
    }
}

$pageTitle = 'Login';
include_once 'includes/header.php';
?>