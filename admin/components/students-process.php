<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Fetch Students with basic stats
$stmt = $pdo->query("
    SELECT u.id, u.username, u.email, u.created_at,
    (SELECT COUNT(*) FROM quiz_attempts WHERE user_id = u.id) as quizzes_taken
    FROM users u
    WHERE role = 'student'
    ORDER BY u.created_at DESC
");
$students = $stmt->fetchAll();

$pageTitle = 'Manage Students';
include_once '../includes/header.php';
?>