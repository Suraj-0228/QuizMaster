<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

// Fetch Top Performers (Total Score across all attempts)
$stmt = $pdo->query("
    SELECT u.id, u.username, SUM(qa.score) as total_score, COUNT(qa.id) as quizzes_taken,
    (SUM(qa.score) / (SELECT SUM(total_questions) FROM quiz_attempts WHERE user_id = u.id) * 100) as avg_accuracy
    FROM quiz_attempts qa
    JOIN users u ON qa.user_id = u.id
    GROUP BY u.id
    ORDER BY total_score DESC
    LIMIT 20
");
$leaders = $stmt->fetchAll();

// Current User Rank Logic
$user_id = $_SESSION['user_id'];
$my_rank = 0;
foreach ($leaders as $idx => $user) {
    if ($user['id'] == $user_id) {
        $my_rank = $idx + 1;
        break;
    }
}

$top3 = array_slice($leaders, 0, 3);
$rest = array_slice($leaders, 3);

$pageTitle = 'Global Leaderboard';
include_once '../includes/header.php';
?>