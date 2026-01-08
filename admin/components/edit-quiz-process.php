<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

if (!isset($_GET['id'])) {
    redirect('quizzes.php');
}

$quiz_id = $_GET['id'];

// Fetch Quiz Data
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    flash('message', 'Quiz not found', 'danger');
    redirect('quizzes.php');
}

// Fetch Categories
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $category_id = $_POST['category_id'];
    $time_limit = (int)$_POST['time_limit'];
    $passing_score = (int)$_POST['passing_score'];
    
    // Simplified handler: relies on JS for required checks
    try {
        $stmt = $pdo->prepare("UPDATE quizzes SET title = ?, description = ?, category_id = ?, time_limit = ?, passing_score = ? WHERE id = ?");
        $stmt->execute([$title, $description, $category_id, $time_limit, $passing_score, $quiz_id]);
        flash('message', 'Quiz updated successfully', 'success');
        redirect('quizzes.php');
    } catch (PDOException $e) {
        flash('message', 'Error: ' . $e->getMessage(), 'danger');
    }
}

$pageTitle = 'Edit Quiz';
include_once '../includes/header.php';
?>