<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['attempt_id'])) {
    redirect('dashboard.php');
}

$attempt_id = $_GET['attempt_id'];
$user_id = $_SESSION['user_id'];

// Fetch Attempt Details
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, q.passing_score, q.id as quiz_id
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.id = ? AND qa.user_id = ?
");
$stmt->execute([$attempt_id, $user_id]);
$attempt = $stmt->fetch();

if (!$attempt) {
    redirect('dashboard.php');
}

$percentage = ($attempt['score'] / $attempt['total_questions']) * 100;
$passed = $percentage >= $attempt['passing_score'];
$circle_color = $passed ? '#10b981' : '#ef4444'; // Success green or Danger red

$pageTitle = 'Quiz Results';
include_once '../includes/header.php';
?>