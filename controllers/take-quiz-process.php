<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['id'])) {
    redirect('quizzes.php');
}

$quiz_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch Quiz
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

// Fetch Questions
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ? ORDER BY RAND()"); // Randomize order
$stmt->execute([$quiz_id]);
$questions = $stmt->fetchAll();

if (count($questions) == 0) {
    flash('message', 'This quiz has no questions yet.', 'warning');
    redirect('quizzes.php');
}

// Handle Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
    $score = 0;
    $total_questions = count($questions);
    $correct_answers_count = 0;
    
    // Start Transaction
    try {
        $pdo->beginTransaction();
        
        // Create Attempt
        $stmt = $pdo->prepare("INSERT INTO quiz_attempts (user_id, quiz_id, total_questions, started_at, completed_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$user_id, $quiz_id, $total_questions]);
        $attempt_id = $pdo->lastInsertId();
        
        // Process Answers
        foreach ($questions as $q) {
            $qid = $q['id'];
            $selected_option_id = isset($answers[$qid]) ? $answers[$qid] : null;
            $is_correct = 0;
            
            if ($selected_option_id) {
                // Check correctness
                $chk = $pdo->prepare("SELECT is_correct FROM options WHERE id = ? AND question_id = ?");
                $chk->execute([$selected_option_id, $qid]);
                $opt = $chk->fetch();
                if ($opt && $opt['is_correct']) {
                    $is_correct = 1;
                    $score += 1;
                    $correct_answers_count++;
                }
            }
            
            // Save User Answer
            $ans_stmt = $pdo->prepare("INSERT INTO user_answers (attempt_id, question_id, selected_option_id, is_correct) VALUES (?, ?, ?, ?)");
            $ans_stmt->execute([$attempt_id, $qid, $selected_option_id, $is_correct]);
        }
        
        // Update Attempt with Score
        $update_stmt = $pdo->prepare("UPDATE quiz_attempts SET score = ?, correct_answers = ? WHERE id = ?");
        $update_stmt->execute([$score, $correct_answers_count, $attempt_id]);
        
        $pdo->commit();
        redirect("results.php?attempt_id=$attempt_id");
        
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error processing quiz: " . $e->getMessage());
    }
}

$pageTitle = 'Take Quiz';
include_once '../includes/header.php';
?>
