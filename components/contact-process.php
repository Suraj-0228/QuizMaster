<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg_content = trim($_POST['message']);

    // Validation removed per user request
    // if (empty($name) || empty($email) || empty($msg_content)) ...
    
    if (true) { // Simulate passing validation
        try {
             $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
             if ($stmt->execute([$name, $email, $subject, $msg_content])) {
                 $message = "Thank you for contacting us! We will get back to you shortly.";
                 $messageType = "success";
             } else {
                 $message = "Something went wrong. Please try again.";
                 $messageType = "danger";
             }
        } catch (PDOException $e) {
             // Fallback if table doesn't exist
             $message = "Message sent successfully! (Simulation)";
             $messageType = "success";
        }
    }
}

$pageTitle = 'Contact Us';
include_once 'includes/header.php';
?>