<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Fetch Statistics
$stats = [];
$stats['students'] = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetchColumn();
$stats['quizzes'] = $pdo->query("SELECT COUNT(*) FROM quizzes")->fetchColumn();
$stats['questions'] = $pdo->query("SELECT COUNT(*) FROM questions")->fetchColumn();
$stats['attempts'] = $pdo->query("SELECT COUNT(*) FROM quiz_attempts")->fetchColumn();

// Recent Activity (Last 5 quiz attempts)
$stmt = $pdo->query("
    SELECT qa.*, u.username, q.title as quiz_title 
    FROM quiz_attempts qa 
    JOIN users u ON qa.user_id = u.id 
    JOIN quizzes q ON qa.quiz_id = q.id 
    ORDER BY qa.completed_at DESC LIMIT 5
");
$recent_attempts = $stmt->fetchAll();

$pageTitle = 'Admin Dashboard';
include_once '../includes/header.php';
?>