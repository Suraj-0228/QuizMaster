<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

function sendEmail($toEmail, $toName, $subject, $htmlBody, $plainTextBody = '') {
    $mail = new PHPMailer(true);
    
    try {
        // --- Server settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        
        // REPLACE THESE WITH YOUR NEW EMAIL CREDENTIALS
        $mail->Username   = 'quizmastera524@gmail.com';                     
        $mail->Password   = 'liyc likk ydoy wkat';                               
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

        // --- Recipients ---
        $mail->setFrom('quizmastera524@gmail.com', 'QuizMaster System');
        $mail->addAddress($toEmail, $toName);

        // --- Content ---
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = $plainTextBody ?: strip_tags($htmlBody);

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log error silently so it doesn't break the application
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
