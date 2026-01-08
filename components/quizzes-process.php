<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

// Fetch Quizzes
$query = "
    SELECT q.*, c.name as category_name, 
    (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) as question_count
    FROM quizzes q 
    LEFT JOIN categories c ON q.category_id = c.id 
    ORDER BY q.created_at DESC
";
$quizzes = $pdo->query($query)->fetchAll();

$pageTitle = 'Available Quizzes';
include_once '../includes/header.php';
?>