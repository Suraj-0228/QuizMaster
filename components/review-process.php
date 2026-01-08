<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['attempt_id'])) {
    redirect('dashboard.php');
}

$attempt_id = $_GET['attempt_id'];
$user_id = $_SESSION['user_id'];

// Fetch Attempt Details with Validation
if (isAdmin()) {
    $stmt = $pdo->prepare("
        SELECT qa.*, q.title, q.passing_score, u.username 
        FROM quiz_attempts qa 
        JOIN quizzes q ON qa.quiz_id = q.id 
        JOIN users u ON qa.user_id = u.id
        WHERE qa.id = ?
    ");
    $stmt->execute([$attempt_id]);
} else {
    $stmt = $pdo->prepare("
        SELECT qa.*, q.title, q.passing_score 
        FROM quiz_attempts qa 
        JOIN quizzes q ON qa.quiz_id = q.id 
        WHERE qa.id = ? AND qa.user_id = ?
    ");
    $stmt->execute([$attempt_id, $user_id]);
}

$attempt = $stmt->fetch();

if (!$attempt) {
    flash('message', 'Quiz attempt not found or access denied.', 'danger');
    redirect('dashboard.php');
}

// Fetch Questions and Answers
$stmt = $pdo->prepare("
    SELECT q.*, ua.selected_option_id, ua.is_correct as user_is_correct,
           (SELECT option_text FROM options WHERE id = ua.selected_option_id) as user_answer_text
    FROM questions q 
    JOIN user_answers ua ON q.id = ua.question_id 
    WHERE ua.attempt_id = ?
");
$stmt->execute([$attempt_id]);
$questions = $stmt->fetchAll();

$pageTitle = 'Review Quiz: ' . $attempt['title'];
include_once '../includes/header.php';
?>