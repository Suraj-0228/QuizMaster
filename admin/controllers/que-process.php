<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

if (!isset($_GET['quiz_id'])) {
    redirect('quizzes.php');
}

$quiz_id = $_GET['quiz_id'];

// Check if quiz exists
$stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

// Handle Delete Question
if (isset($_POST['delete_question'])) {
    $question_id = $_POST['question_id'];
    $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$question_id]);
    flash('message', 'Question deleted successfully', 'success');
    redirect("questions.php?quiz_id=$quiz_id");
}

// Fetch Questions with Options
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ? ORDER BY created_at ASC");
$stmt->execute([$quiz_id]);
$questions = $stmt->fetchAll();

$pageTitle = 'Manage Questions';
include_once '../includes/header.php';
?>