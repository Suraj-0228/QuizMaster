<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Check if registration is allowed
    if (!isRegistrationAllowed()) {
        $errors[] = "Registration is currently closed.";
    } else {
        $username = sanitize($_POST['username']);
        $email = sanitize($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Email Validation
        if (strpos($email, '@') === false) {
            $errors[] = "Email must contain '@'.";
        }
        if (substr($email, -4) !== '.com') {
            $errors[] = "Email must end with '.com'.";
        }

        // Validation - Client side mostly, but check DB
        if (empty($errors)) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
            $stmt->execute([$email, $username]);
            if ($stmt->rowCount() > 0) {
                $errors[] = "Username or Email Already Exists!!";
            }
        }

        // Process registration
        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'student')");
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if ($stmt->execute([$username, $email, $hashed_password])) {
                    flash('message', 'Registration Successful!! Please login!!', 'success');
                    redirect('login.php');
                } else {
                    $errors[] = "Something went Wrong!! Please try again!!";
                }
            } catch (Exception $e) {
                $errors[] = "Error: " . $e->getMessage() . "!!";
            }
        }
    }
}

$pageTitle = 'Register';
include_once 'includes/header.php';
?>