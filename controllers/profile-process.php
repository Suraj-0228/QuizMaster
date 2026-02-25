<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$message = '';

// Handle POST Requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Quick action: Remove Profile Picture Only
    if (isset($_POST['remove_profile_pic_only'])) {
        $stmt_current = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
        $stmt_current->execute([$user_id]);
        $current_pic = $stmt_current->fetchColumn();

        if ($current_pic) {
            $stmt = $pdo->prepare("UPDATE users SET profile_pic = NULL WHERE id = ?");
            if ($stmt->execute([$user_id])) {
                if (file_exists('../assets/images/profiles/' . $current_pic)) {
                    unlink('../assets/images/profiles/' . $current_pic);
                }
                flash('message', 'Profile Picture Removed Successfully.', 'success');
            } else {
                flash('message', 'Failed to Remove Profile Picture.', 'danger');
            }
        }
        redirect('profile.php');
        exit;
    }
    
    // 1. Change Password
    if (isset($_POST['update_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($stmt->execute([$password, $user_id])) {
                flash('message', 'Password Updated Successfully.', 'success');
            } else {
                flash('message', 'Error Updating Password.', 'danger');
            }
    }

    // 2. Update Profile (Username, Email, Bio, Profile Pic)
    if (isset($_POST['update_profile'])) {
        $new_username = trim($_POST['username']);
        $new_email = trim($_POST['email']);
        $new_bio = trim($_POST['bio']);
        $profile_pic_name = null;
        $remove_pic = isset($_POST['remove_profile_pic']) && $_POST['remove_profile_pic'] == '1';

        // Fetch current user details to get existing profile pic if needed
        $stmt_current = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
        $stmt_current->execute([$user_id]);
        $current_user = $stmt_current->fetch();
        $current_pic = $current_user['profile_pic'] ?? null;

        // Handle Profile Picture Upload OR Removal
        if ($remove_pic) {
            // Flag to remove
            $profile_pic_name = 'REMOVE'; 
        } elseif (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../assets/images/profiles/';
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_tmp = $_FILES['profile_pic']['tmp_name'];
            $file_name = $_FILES['profile_pic']['name'];
            $file_size = $_FILES['profile_pic']['size'];
            
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($file_ext, $allowed_exts)) {
                flash('message', 'Invalid image format. Only JPG, PNG, and GIF are allowed.', 'danger');
                redirect('profile.php');
                exit;
            } elseif ($file_size > 2097152) { // 2MB limit
                flash('message', 'Image size must be less than 2MB.', 'danger');
                redirect('profile.php');
                exit;
            } else {
                // Generate a unique file name
                $profile_pic_name = $user_id . '_' . time() . '.' . $file_ext;
                $upload_path = $upload_dir . $profile_pic_name;
                
                if (!move_uploaded_file($file_tmp, $upload_path)) {
                    flash('message', 'Error uploading image.', 'danger');
                    redirect('profile.php');
                    exit;
                }
            }
        }
        
        // Basic Validation
        if (empty($new_username) || empty($new_email)) {
             flash('message', 'Username and Email are required.', 'warning');
        } else {
            // Check for duplicate username/email (excluding current user)
            $check = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
            $check->execute([$new_username, $new_email, $user_id]);
            
            if ($check->rowCount() > 0) {
                 flash('message', 'Username or Email already taken.', 'danger');
            } else {
                // Update Database
                if ($profile_pic_name === 'REMOVE') {
                    // Remove picture from DB and File System
                    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, bio = ?, profile_pic = NULL WHERE id = ?");
                    $update_params = [$new_username, $new_email, $new_bio, $user_id];
                    
                    if ($current_pic && file_exists('../assets/images/profiles/' . $current_pic)) {
                        unlink('../assets/images/profiles/' . $current_pic);
                    }
                } elseif ($profile_pic_name) {
                    // Update including new profile picture
                    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, bio = ?, profile_pic = ? WHERE id = ?");
                    $update_params = [$new_username, $new_email, $new_bio, $profile_pic_name, $user_id];
                    
                    // Remove old pic
                    if ($current_pic && file_exists('../assets/images/profiles/' . $current_pic)) {
                        unlink('../assets/images/profiles/' . $current_pic);
                    }
                } else {
                    // Update without changing profile picture
                    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, bio = ? WHERE id = ?");
                    $update_params = [$new_username, $new_email, $new_bio, $user_id];
                }

                if ($stmt->execute($update_params)) {
                    // Update Session Username if changed
                    $_SESSION['username'] = $new_username;
                    
                    flash('message', 'Profile updated successfully!', 'success');
                    header("Location: profile.php");
                    exit;
                } else {
                    flash('message', 'Error updating profile.', 'danger');
                }
            }
        }
    }
    
    // 3. Delete Account
    if (isset($_POST['delete_account'])) {
        $confirm_delete = $_POST['confirm_delete'];
        if ($confirm_delete === 'DELETE') {
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $pdo->commit();
                
                session_destroy();
                redirect('../login.php?msg=account_deleted');
            } catch (Exception $e) {
                $pdo->rollBack();
                flash('message', 'Error deleting account: ' . $e->getMessage(), 'danger');
            }
        } else {
            flash('message', 'Please type DELETE to confirm.', 'warning');
        }
    }
}

// Fetch User Data
$stmt = $pdo->prepare("SELECT username, email, role, bio, created_at, profile_pic FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Stats
$quizzes_taken = $pdo->prepare("SELECT COUNT(*) FROM quiz_attempts WHERE user_id = ?");
$quizzes_taken->execute([$user_id]);
$stats_count = $quizzes_taken->fetchColumn();

// Avg Score
$avg_score_stmt = $pdo->prepare("SELECT AVG((score/total_questions)*100) FROM quiz_attempts WHERE user_id = ? AND total_questions > 0");
$avg_score_stmt->execute([$user_id]);
$avg_score = round((float)$avg_score_stmt->fetchColumn(), 1);

$pageTitle = 'My Profile';
include_once '../includes/header.php';
?>