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
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
            $errors[] = "Invalid Email ID!! Email must be in (example@gmail.com) Format.";
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
                $default_bio = "Hello, I'm " . $username . ". I'm a passionate learner using QuizMaster to improve my skills. Challenge me to a quiz!";
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role, bio) VALUES (?, ?, ?, 'student', ?)");
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if ($stmt->execute([$username, $email, $hashed_password, $default_bio])) {
                    // Send Welcome Email
                    require_once __DIR__ . '/../includes/mail_helper.php';
                    $subject = 'Welcome to QuizMaster!';
                    $body = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f4f7f6; padding: 20px; border-radius: 8px;">
                        <div style="background-color: #4CAF50; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h1 style="color: white; margin: 0; font-size: 24px;">QuizMaster</h1>
                        </div>
                        <div style="background-color: white; padding: 30px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <h2 style="color: #333; margin-top: 0;">Welcome ' . $username . '!</h2>
                            <p style="color: #555; line-height: 1.6; font-size: 16px;">
                                Your QuizMaster Account has been Successfully Created.<br>
                                You can now Login and Start Taking Quizzes!
                            </p>
                            <div style="text-align: center; margin-top: 30px; margin-bottom: 10px;">
                                <a href="http://localhost/QuizMaster/login.php" style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Login to your account</a>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 20px; color: #888; font-size: 12px;">
                            &copy; ' . date('Y') . ' QuizMaster. All rights reserved.
                        </div>
                    </div>';
                    sendEmail($email, $username, $subject, $body);

                    flash('message', 'Registration Successful!! Please Login!!', 'success');
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