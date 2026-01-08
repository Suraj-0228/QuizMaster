<?php
if (session_status() === PHP_SESSION_NONE) {
    include_once __DIR__ . '/functions.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Quiz System' : 'Online Quiz System'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/QuizMaster/assets/css/style.css">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
<?php 
if (isLoggedIn() && isAdmin()) {
    // Admin Layout
    include_once __DIR__ . '/admin-sidebar.php';
    echo '<div class="admin-main-content d-flex flex-column min-vh-100">';
} else {
    // Student/Public Layout
    include_once __DIR__ . '/navbar.php';
}
?>

<div class="<?php echo (isLoggedIn() && isAdmin()) ? 'container-fluid' : 'container'; ?> mt-4 mb-5">
    <?php flash('message'); ?>
