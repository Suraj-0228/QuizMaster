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
        $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $email]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) { // Plain text comparison
            // Login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                redirect('admin/dashboard.php');
            } else {
                redirect('student/dashboard.php');
            }
        } else {
            $error = "Invalid credentials";
        }
    }
}

$pageTitle = 'Login';
include_once 'includes/header.php';
?>