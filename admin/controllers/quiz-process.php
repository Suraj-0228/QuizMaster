<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Fetch Categories
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $category_id = $_POST['category_id'];
    $time_limit = (int)$_POST['time_limit'];
    $passing_score = (int)$_POST['passing_score'];
    
    // Simplified handler: relies on JS for checks
    try {
        $stmt = $pdo->prepare("INSERT INTO quizzes (title, description, category_id, time_limit, passing_score, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $category_id, $time_limit, $passing_score, $_SESSION['user_id']]);
        flash('message', 'Quiz created successfully', 'success');
        redirect('quizzes.php');
    } catch (PDOException $e) {
        flash('message', 'Error: ' . $e->getMessage(), 'danger');
    }
}

$pageTitle = 'Add New Quiz';
include_once '../includes/header.php';
?>
