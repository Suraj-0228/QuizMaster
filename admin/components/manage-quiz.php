<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Handle Delete
if (isset($_POST['delete_quiz'])) {
    $quiz_id = $_POST['quiz_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->execute([$quiz_id]);
        flash('message', 'Quiz deleted successfully', 'success');
        redirect('quizzes.php');
    } catch (PDOException $e) {
        flash('message', 'Error deleting quiz: ' . $e->getMessage(), 'danger');
    }
}

// Fetch Quizzes
$stmt = $pdo->query("
    SELECT q.*, c.name as category_name, u.username as creator,
    (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) as question_count
    FROM quizzes q 
    LEFT JOIN categories c ON q.category_id = c.id 
    JOIN users u ON q.created_by = u.id
    ORDER BY q.created_at DESC
");
$quizzes = $stmt->fetchAll();

$pageTitle = 'Manage Quizzes';
include_once '../includes/header.php';
?>