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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = sanitize($_POST['question_text']);
    $question_type = 'multiple_choice'; // Defaulting for simplicity
    $marks = (int)$_POST['marks'];
    $correct_option = (int)$_POST['correct_option'];
    $options = $_POST['options'];

    // Simplified handler: relies on JS for required checks
    try {
        $pdo->beginTransaction();

        // Insert Question
        $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text, question_type, marks) VALUES (?, ?, ?, ?)");
        $stmt->execute([$quiz_id, $question_text, $question_type, $marks]);
        $question_id = $pdo->lastInsertId();

        // Insert Options
        foreach ($options as $index => $option_text) {
            if (!empty(trim($option_text))) {
                $is_correct = ($index + 1) === $correct_option ? 1 : 0;
                $stmt = $pdo->prepare("INSERT INTO options (question_id, option_text, is_correct) VALUES (?, ?, ?)");
                $stmt->execute([$question_id, sanitize($option_text), $is_correct]);
            }
        }

        $pdo->commit();
        flash('message', 'Question added successfully', 'success');
        redirect("questions.php?quiz_id=$quiz_id");

    } catch (Exception $e) {
        $pdo->rollBack();
        flash('message', 'Error: ' . $e->getMessage(), 'danger');
    }
}

$pageTitle = 'Add Question';
include_once '../includes/header.php';
?>
