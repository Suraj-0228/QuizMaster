<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    
    if (empty($errors)) {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Generate unique secure token
            $token = bin2hex(random_bytes(32));
            
            // Save token mapping to DB using MySQL's NOW() to prevent timezone mismatch expiration issues
            $update_stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expires_at = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE id = ?");
            if ($update_stmt->execute([$token, $user['id']])) {
                
                // Construct URL dynamically to support both localhost and local network IP addresses
                $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/QuizMaster/reset-password.php?token=" . $token;
                
                // Format and send email
                require_once __DIR__ . '/../includes/mail_helper.php';
                $subject = 'Reset Your QuizMaster Password';
                $body = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f4f7f6; padding: 20px; border-radius: 8px;">
                    <div style="background-color: #4CAF50; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                        <h1 style="color: white; margin: 0; font-size: 24px;">QuizMaster Security</h1>
                    </div>
                    <div style="background-color: white; padding: 30px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h2 style="color: #333; margin-top: 0;">Password Reset Request</h2>
                        <p style="color: #555; line-height: 1.6; font-size: 16px;">
                            Hello ' . $user['username'] . ',<br><br>
                            We received a request to reset your QuizMaster password. This link is valid for exactly 15 minutes.
                        </p>
                        <div style="text-align: center; margin-top: 30px; margin-bottom: 20px;">
                            <a href="' . $reset_link . '" style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Reset Password</a>
                        </div>
                        <p style="color: #888; font-size: 13px;">If you did not request this, you can safely ignore this email.</p>
                    </div>
                </div>';
                
                sendEmail($email, $user['username'], $subject, $body);
            }
        }
        
        // Security Best Practice: Never reveal if the email exists in the DB.
        // Always flash success message regardless of if the email was found.
        flash('message', 'If that email exists in our system, a password reset link has been sent.', 'info');
        redirect('login.php');
    }
}

$pageTitle = 'Forgot Password';
include_once 'includes/header.php';
?>
