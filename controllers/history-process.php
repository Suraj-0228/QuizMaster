<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

$user_id = $_SESSION['user_id'];

// Fetch detailed history with passing score check
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, q.passing_score 
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.user_id = ? 
    ORDER BY qa.completed_at DESC
");
$stmt->execute([$user_id]);
$history = $stmt->fetchAll();

$pageTitle = 'My Quiz History';
include_once '../includes/header.php';
?>
