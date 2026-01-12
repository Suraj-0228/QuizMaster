<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
        
        if ($user_id) {
            try {
                if ($_POST['action'] === 'delete') {
                    // Delete related data first (cascading usually handles this, but let's be safe if no FK cascade)
                    // Deleting quiz attempts first
                    $pdo->prepare("DELETE FROM quiz_attempts WHERE user_id = ?")->execute([$user_id]);
                    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$user_id]);
                    
                    flash('message', 'Student deleted successfully.', 'success');
                } elseif ($_POST['action'] === 'toggle_block') {
                    // Get current status
                    $stmt = $pdo->prepare("SELECT is_blocked FROM users WHERE id = ?");
                    $stmt->execute([$user_id]);
                    $current = $stmt->fetchColumn();
                    
                    // Toggle
                    $new_status = $current ? 0 : 1;
                    $stmt = $pdo->prepare("UPDATE users SET is_blocked = ? WHERE id = ?");
                    $stmt->execute([$new_status, $user_id]);
                    
                    $msg = $new_status ? 'Student blocked successfully.' : 'Student unblocked successfully.';
                    flash('message', $msg, 'warning'); // Warning color for block status
                }
                
                // Redirect to avoid resubmission
                header("Location: students.php");
                exit;
                
            } catch (PDOException $e) {
                flash('message', 'Error: ' . $e->getMessage(), 'danger');
            }
        }
    }
}

// Fetch Students with basic stats
// Ensure we fetch is_blocked. If column doesn't exist yet, this might error, 
// but user asked to implement the action.
$stmt = $pdo->query("
    SELECT u.id, u.username, u.email, u.created_at, u.is_blocked,
    (SELECT COUNT(*) FROM quiz_attempts WHERE user_id = u.id) as quizzes_taken
    FROM users u
    WHERE role = 'student'
    ORDER BY u.created_at DESC
");
$students = $stmt->fetchAll();

$pageTitle = 'Manage Students';
include_once '../includes/header.php';
?>