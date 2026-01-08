<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

if (!isset($_GET['id'])) {
    redirect('students.php');
}

$student_id = $_GET['id'];

// Fetch Student Info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'student'");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

if (!$student) {
    flash('message', 'Student not found', 'danger');
    redirect('students.php');
}

// Fetch Quiz History
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, 
    (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) as quiz_total 
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.user_id = ? 
    ORDER BY qa.started_at DESC
");
$stmt->execute([$student_id]);
$attempts = $stmt->fetchAll();

$pageTitle = 'Student Details: ' . $student['username'];
include_once '../includes/header.php';
?>