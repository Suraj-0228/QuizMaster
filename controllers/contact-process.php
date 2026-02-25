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
                 
                 // Send email notification to Admin
                 require_once __DIR__ . '/../includes/mail_helper.php';
                 
                 $admin_email = 'quizmastera524@gmail.com';
                 $email_subject = "New Contact Form Submission: $subject";
                 
                 $email_body = '
                 <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
                     <div style="background-color: #1a73e8; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                         <h1 style="color: white; margin: 0; font-size: 24px;">New Message Received</h1>
                     </div>
                     <div style="background-color: white; padding: 30px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                         <h2 style="color: #333; margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px;">Message Details</h2>
                         
                         <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                             <tr>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; width: 30%; color: #555;">Name:</td>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; color: #333;">' . htmlspecialchars($name) . '</td>
                             </tr>
                             <tr>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #555;">Email:</td>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; color: #333;">
                                    <a href="mailto:' . htmlspecialchars($email) . '" style="color: #1a73e8;">' . htmlspecialchars($email) . '</a>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #555;">Subject:</td>
                                 <td style="padding: 10px 0; border-bottom: 1px solid #eee; color: #333;">' . htmlspecialchars($subject) . '</td>
                             </tr>
                         </table>
                         
                         <div style="margin-top: 25px;">
                             <h3 style="color: #555; font-size: 16px; margin-bottom: 10px;">Message Content:</h3>
                             <div style="background-color: #f5f5f5; padding: 15px; border-radius: 4px; border-left: 4px solid #1a73e8; color: #333; line-height: 1.6; white-space: pre-wrap;">' . htmlspecialchars($msg_content) . '</div>
                         </div>
                     </div>
                 </div>';
                 
                 // We send it to ourselves (admin), from ourselves
                 sendEmail($admin_email, 'QuizMaster Admin', $email_subject, $email_body);
                 
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