<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

$user_id = $_SESSION['user_id'];

// Stats
$quizzes_taken = $pdo->prepare("SELECT COUNT(*) FROM quiz_attempts WHERE user_id = ?");
$quizzes_taken->execute([$user_id]);
$total_attempts = $quizzes_taken->fetchColumn();

// Average Score
$avg_score_stmt = $pdo->prepare("SELECT AVG((score/total_questions)*100) FROM quiz_attempts WHERE user_id = ? AND total_questions > 0");
$avg_score_stmt->execute([$user_id]);
$avg_score = round((float)$avg_score_stmt->fetchColumn(), 1);

// Recent Quizzes
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, q.time_limit 
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.user_id = ? 
    ORDER BY qa.completed_at DESC LIMIT 5
");
$stmt->execute([$user_id]);
$recent_history = $stmt->fetchAll();

$pageTitle = 'Student Dashboard';
include_once '../includes/header.php';
?>