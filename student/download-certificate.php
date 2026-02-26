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

class PDF_Certificate extends FPDF {
    function Polygon($points, $style='D') {
        if(count($points) % 2 != 0) {
            $this->Error('Polygon: Invalid number of points (must be an even number)');
        }
        $points[] = $points[0];
        $points[] = $points[1];
        $op = 'S';
        if($style=='F')
            $op = 'f';
        elseif($style=='FD' || $style=='DF')
            $op = 'b';
        
        $this->_out(sprintf('%.2F %.2F m', $points[0]*$this->k, ($this->h-$points[1])*$this->k));
        for($i=2; $i<count($points)-2; $i+=2) {
            $this->_out(sprintf('%.2F %.2F l', $points[$i]*$this->k, ($this->h-$points[$i+1])*$this->k));
        }
        $this->_out($op);
    }
    
    function DrawShapeScaled($commands, $scaleX = 0.27, $scaleY = 0.2692, $style='F') {
        $op = 'f';
        if($style=='D') $op = 'S';
        elseif($style=='FD' || $style=='DF') $op = 'B';
        
        $out = '';
        foreach($commands as $cmd) {
            $type = $cmd[0];
            if ($type == 'M') {
                $x = $cmd[1] * $scaleX; $y = $cmd[2] * $scaleY;
                $out .= sprintf('%.2F %.2F m ', $x*$this->k, ($this->h-$y)*$this->k);
            } elseif ($type == 'L') {
                $x = $cmd[1] * $scaleX; $y = $cmd[2] * $scaleY;
                $out .= sprintf('%.2F %.2F l ', $x*$this->k, ($this->h-$y)*$this->k);
            } elseif ($type == 'C') {
                $x1 = $cmd[1] * $scaleX; $y1 = $cmd[2] * $scaleY;
                $x2 = $cmd[3] * $scaleX; $y2 = $cmd[4] * $scaleY;
                $x3 = $cmd[5] * $scaleX; $y3 = $cmd[6] * $scaleY;
                $out .= sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', 
                    $x1*$this->k, ($this->h-$y1)*$this->k,
                    $x2*$this->k, ($this->h-$y2)*$this->k,
                    $x3*$this->k, ($this->h-$y3)*$this->k);
            }
        }
        $out .= $op;
        $this->_out($out);
    }
}

$pdf = new PDF_Certificate('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

// Colors
$navy = [14, 30, 59]; // #0e1e3b
$gold = [206, 156, 58]; // #ce9c3a
$grayText = [136, 136, 136]; // #888

// 1. Background Fill (White)
$pdf->SetFillColor(255, 255, 255);
$pdf->Rect(0, 0, 297, 210, 'F');

// 2. Gray Sweeps (approximated with light gray color #f4f5f7)
$pdf->SetFillColor(244, 245, 247);
$pdf->DrawShapeScaled([
    ['M', 0, 0], ['L', 350, 0], ['C', 200, 300, 150, 550, 0, 780], ['L', 0, 0]
]);
$pdf->DrawShapeScaled([
    ['M', 1100, 0], ['L', 850, 0], ['C', 1000, 300, 1050, 550, 1100, 780], ['L', 1100, 0]
]);

// 3. Bottom Gold and Navy Sweeps
// Gold Layer
$pdf->SetFillColor($gold[0], $gold[1], $gold[2]);
$pdf->DrawShapeScaled([
    ['M', 0, 540], ['C', 400, 760, 800, 820, 1100, 560], ['L', 1100, 800], ['L', 0, 800], ['L', 0, 540]
]);

// Navy Layer
$pdf->SetFillColor($navy[0], $navy[1], $navy[2]);
$pdf->DrawShapeScaled([
    ['M', 0, 560], ['C', 400, 780, 800, 840, 1100, 580], ['L', 1100, 800], ['L', 0, 800], ['L', 0, 560]
]);

// 4. Gold Border
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->SetLineWidth(1);
$pdf->Rect(7, 7, 283, 196); // 25px in 1100px is ~ 6.75mm

// 5. Right Navy Ribbon & Seal
$ribbonX = 250;
$ribbonW = 24;
$ribbonH = 108;
$pdf->SetFillColor($navy[0], $navy[1], $navy[2]);
$pdf->Polygon([
    $ribbonX, 0,
    $ribbonX + $ribbonW, 0,
    $ribbonX + $ribbonW, $ribbonH,
    $ribbonX + ($ribbonW/2), $ribbonH - 13,
    $ribbonX, $ribbonH
], 'F');

// Seal
$sealSize = 90; // Size in mm
$sealX = $ribbonX + ($ribbonW/2) - ($sealSize/2);
$sealY = $ribbonH - 18 - ($sealSize/2);
$imagePath = __DIR__ . '/../assets/images/Achievement Badge.png';
if (file_exists($imagePath)) {
    $pdf->Image($imagePath, $sealX, $sealY, $sealSize, $sealSize, 'PNG');
}

// 6. Typography Output

$centerX = 148.5;

// Header "CERTIFICATE"
$pdf->SetFont('Times', 'B', 46);
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);
$pdf->SetY(43);
$pdf->SetX($centerX - 100);
$pdf->Cell(200, 20, 'CERTIFICATE', 0, 1, 'C');

// Subheader "OF EXCELLENCE"
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor($gold[0], $gold[1], $gold[2]);
$pdf->SetY(65);
$pdf->SetX($centerX - 100);
$pdf->Cell(200, 10, 'OF EXCELLENCE', 0, 1, 'C');

// Subheader lines
$pdf->SetDrawColor($gold[0], $gold[1], $gold[2]);
$pdf->SetLineWidth(0.3);
$pdf->Line($centerX - 60, 70, $centerX - 25, 70);
$pdf->Line($centerX + 25, 70, $centerX + 60, 70);

// "THIS CERTIFICATE IS PROUDLY PRESENTED TO"
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);
$pdf->SetY(85);
$pdf->SetX($centerX - 100);
$pdf->Cell(200, 10, 'THIS CERTIFICATE IS PROUDLY PRESENTED TO', 0, 1, 'C');

// Recipient Name
$pdf->SetFont('Times', 'I', 42); // FPDF does not support Playfair natively without embedding, Times italic works
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);
$pdf->SetY(100);
$pdf->SetX($centerX - 100);
$pdf->Cell(200, 15, sanitize($attempt['username']), 0, 1, 'C');

// Subtle Dotted Line under name
$pdf->SetDrawColor(136, 136, 136);
$pdf->SetLineWidth(0.4);
$pdf->Line($centerX - 65, 118, $centerX + 65, 118);

// Quiz Title
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor($gold[0], $gold[1], $gold[2]);
$pdf->SetY(125);
$pdf->SetX($centerX - 100);
$pdf->Cell(200, 8, strtoupper(sanitize($attempt['quiz_title'])), 0, 1, 'C');

// Description
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);
$pdf->SetY(135);
$pdf->SetX($centerX - 80);
$desc = "For successfully completing the assessment and demonstrating outstanding\nknowledge, skill, and expertise in the subject with a passing score of " . round($percentage) . "%.";
$pdf->MultiCell(160, 6, $desc, 0, 'C');

// Footer Section
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);

// Date block
$pdf->SetY(165);
$pdf->SetX($centerX - 80);
$pdf->Cell(45, 5, date('M d, Y', strtotime($attempt['completed_at'])), 0, 0, 'C');
$pdf->SetDrawColor(136, 136, 136);
$pdf->Line($centerX - 80, 172, $centerX - 35, 172);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetY(174);
$pdf->SetX($centerX - 80);
$pdf->Cell(45, 5, 'Date', 0, 0, 'C');

// Signature block
$pdf->AddFont('GreatVibes', '', 'GreatVibes-Regular.php');
$pdf->SetFont('GreatVibes', '', 36);
$pdf->SetTextColor($navy[0], $navy[1], $navy[2]);
$pdf->SetY(162);
$pdf->SetX($centerX + 35);
$pdf->Cell(45, 10, 'Suraj Manani', 0, 0, 'C');
$pdf->SetDrawColor(136, 136, 136);
$pdf->Line($centerX + 35, 172, $centerX + 80, 172);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetY(174);
$pdf->SetX($centerX + 35);
$pdf->Cell(45, 5, 'Signature', 0, 0, 'C');

// File name
$fileName = 'Certificate_' . preg_replace('/[^a-zA-Z0-9]+/', '_', $attempt['quiz_title']) . '.pdf';

// Output PDF straight to browser download
$pdf->Output('D', $fileName);
exit;

