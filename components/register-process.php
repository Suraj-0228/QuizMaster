<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    // Validation - REMOVED per user request (Client-side only)
    // if (empty($username)) $errors[] = "Username is required";
    // ...
    // if ($password !== $confirm_password) $errors[] = "Passwords do not match";

    // Check if user exists
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
            if ($stmt->execute([$username, $email, $password])) { // Store plain password
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

$pageTitle = 'Register';
include_once 'includes/header.php';
?>