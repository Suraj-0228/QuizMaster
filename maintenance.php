<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - QuizMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/QuizMaster/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/QuizMaster/assets/css/maintenance.css">
</head>
<body>
    <div class="card maintenance-card border-0 rounded-4 text-center p-5">
        <div class="mb-4 position-relative d-inline-block">
            <i class="fas fa-cog fa-5x gear-icon opacity-75"></i>
            <i class="fas fa-wrench fa-2x tool-icon"></i>
        </div>
        
        <h1 class="display-5 fw-bold text-light mb-3">Under Maintenance</h1>
        <p class="lead text-light opacity-75 mb-4">
            We are currently upgrading our system to provide you a better experience. 
            We'll be back shortly!
        </p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="/QuizMaster/logout.php" class="btn btn-outline-light rounded-pill px-4 py-2">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
            <a href="#" onclick="window.location.reload()" class="btn btn-primary rounded-pill px-4 py-2 btn-glow">Check Again</a>
        </div>
        
        <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
            <small class="text-muted">Expected downtime: ~1 hour</small>
        </div>
    </div>
</body>
</html>
