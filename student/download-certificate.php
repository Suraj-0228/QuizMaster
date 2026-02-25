<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/fpdf/fpdf.php';

requireLogin();

if (!isset($_GET['attempt_id'])) {
    redirect('history.php');
}

$attempt_id = (int)$_GET['attempt_id'];

// Fetch attempt details, ensuring it belongs to the logged-in user
$stmt = $pdo->prepare("
    SELECT qa.*, q.title as quiz_title, u.username 
    FROM quiz_attempts qa
    JOIN quizzes q ON qa.quiz_id = q.id
    JOIN users u ON qa.user_id = u.id
    WHERE qa.id = ? AND qa.user_id = ? AND qa.completed_at IS NOT NULL
");
$stmt->execute([$attempt_id, $_SESSION['user_id']]);
$attempt = $stmt->fetch();

if (!$attempt) {
    // Attempt not found or doesn't belong to the user
    flash('message', 'Attempt not found or unauthorized access.', 'danger');
    redirect('history.php');
    exit;
}

// Calculate score percentage
$percentage = ($attempt['total_questions'] > 0) ? ($attempt['score'] / $attempt['total_questions']) * 100 : 0;

// Security check: Only allow downloads if they passed with 75% or more
if ($percentage < 75) {
    flash('message', 'Certificates are only available for scores of 75% or higher.', 'warning');
    redirect("results.php?attempt_id=" . $attempt_id);
    exit;
}

// Ensure no output has been sent before PDF generation
if (ob_get_length()) ob_clean();

// Create PDF Landscape A4
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

// Colors matching website theme
$bgDark = [15, 23, 42]; // Very dark slate blue
$gold = [212, 175, 55]; // Premium gold
$lightText = [241, 245, 249]; // Off-white/slate
$mutedText = [148, 163, 184]; // Slate 400

// Background Fill
$pdf->SetFillColor($bgDark[0], $bgDark[1], $bgDark[2]);
$pdf->Rect(0, 0, 297, 210, 'F');

// Outer Diamond/Corner accents (Gold)
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->SetLineWidth(4);
$pdf->Rect(12, 12, 273, 186); // Outer border

// Inner thin border (Muted)
$pdf->SetDrawColor($mutedText[0], $mutedText[1], $mutedText[2]);
$pdf->SetLineWidth(0.5);
$pdf->Rect(18, 18, 261, 174);

// Header "CERTIFICATE OF ACHIEVEMENT"
$pdf->SetFont('Arial', 'B', 38);
$pdf->SetTextColor($gold[0], $gold[1], $gold[2]);
$pdf->SetY(35);
$pdf->Cell(0, 20, 'CERTIFICATE OF ACHIEVEMENT', 0, 1, 'C');

// Ribbon/Divider Line under header
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->SetLineWidth(1);
$pdf->Line(95, 55, 202, 55);

// Subheader
$pdf->SetFont('Arial', 'I', 16);
$pdf->SetTextColor($mutedText[0], $mutedText[1], $mutedText[2]);
$pdf->SetY(65);
$pdf->Cell(0, 10, 'This proudly certifies that', 0, 1, 'C');

// Recipient Name
$pdf->SetFont('Arial', 'B', 36);
$pdf->SetTextColor($lightText[0], $lightText[1], $lightText[2]);
$pdf->SetY(85);
$pdf->Cell(0, 20, strtoupper(sanitize($attempt['username'])), 0, 1, 'C');

// Underline Name
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->SetLineWidth(1);
$pdf->Line(80, 105, 217, 105);

// Description
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor($mutedText[0], $mutedText[1], $mutedText[2]);
$pdf->SetY(115);
$pdf->Cell(0, 10, 'Has successfully completed the assessment for:', 0, 1, 'C');

// Quiz Title
$pdf->SetFont('Arial', 'B', 28);
$pdf->SetTextColor($gold[0], $gold[1], $gold[2]);
$pdf->SetY(130);
$pdf->Cell(0, 15, sanitize($attempt['quiz_title']), 0, 1, 'C');

// Score
$pdf->SetFont('Arial', '', 14);
$pdf->SetTextColor($lightText[0], $lightText[1], $lightText[2]);
$pdf->SetY(150);
$pdf->Cell(0, 10, 'Achieving a passing score of ' . round($percentage) . '%', 0, 1, 'C');

// Footer Section (Date & Signature line)

// Signature above the line
$pdf->SetFont('Times', 'I', 22);
$pdf->SetTextColor($lightText[0], $lightText[1], $lightText[2]);
$pdf->SetXY(180, 162);
$pdf->Cell(70, 10, 'QuizMaster', 0, 1, 'C');

$pdf->SetY(175);

// Date
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor($mutedText[0], $mutedText[1], $mutedText[2]);
// Position date on left
$pdf->SetX(40);
$pdf->Cell(80, 8, 'Awarded on: ' . date('F j, Y', strtotime($attempt['completed_at'])), 0, 0, 'L');

// Signature Line on right
$pdf->SetX(180);
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->Cell(70, 8, 'QuizMaster Administration', 'T', 1, 'C');

// File name
$fileName = 'Certificate_' . preg_replace('/[^a-zA-Z0-9]+/', '_', $attempt['quiz_title']) . '.pdf';

// Output PDF straight to browser download
$pdf->Output('D', $fileName);
exit;
?>
