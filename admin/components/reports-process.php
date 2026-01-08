<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Fetch All Attempts with correct question count
$stmt = $pdo->query("
    SELECT qa.*, u.username, q.title as quiz_title,
    (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) as total_questions
    FROM quiz_attempts qa
    JOIN users u ON qa.user_id = u.id
    JOIN quizzes q ON qa.quiz_id = q.id
    ORDER BY qa.completed_at DESC
");
$attempts = $stmt->fetchAll();

// Calculate Stats
$total_attempts = count($attempts);
$total_score_percentage = 0;
$passed_count = 0;

foreach ($attempts as $attempt) {
    $q_total = $attempt['total_questions'];
    $percentage = $q_total > 0 ? ($attempt['score'] / $q_total) * 100 : 0;
    $total_score_percentage += $percentage;
    if ($percentage >= 50) {
        $passed_count++;
    }
}

$avg_score = $total_attempts > 0 ? round($total_score_percentage / $total_attempts, 1) : 0;
$pass_rate = $total_attempts > 0 ? round(($passed_count / $total_attempts) * 100, 1) : 0;

$pageTitle = 'Reports & Analytics';
include_once '../includes/header.php';
?>