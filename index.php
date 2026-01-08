<?php
$pageTitle = 'Home';
include_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-shape" style="top: -100px; right: -100px;"></div>
    <div class="hero-shape" style="bottom: -100px; left: -100px; width: 400px; height: 400px; background: radial-gradient(circle at center, rgba(16, 185, 129, 0.1) 0%, rgba(13, 27, 42, 0) 70%);"></div>
    
    <div class="row align-items-center">
        <div class="col-lg-7">
            <h1 class="display-3 fw-bold mb-4 lh-tight">
                Unlock Your Potential with <br>
                <span class="text-gradient">QuizMaster</span>
            </h1>
            <p class="lead text-muted mb-5 pe-lg-5">
                The ultimate platform to test your knowledge, challenge your friends, and track your learning journey. Join thousands of learners today.
            </p>
            <div class="d-grid gap-3 d-sm-flex">
                <?php if(isLoggedIn()): ?>
                    <?php if(isAdmin()): ?>
                        <a href="admin/dashboard.php" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">Go to Dashboard <i class="fas fa-arrow-right ms-2"></i></a>
                    <?php else: ?>
                        <a href="student/dashboard.php" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">Start Learning <i class="fas fa-arrow-right ms-2"></i></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">Get Started Free</a>
                    <a href="login.php" class="btn btn-outline-light btn-lg px-5 rounded-pill">Sign In</a>
                <?php endif; ?>
            </div>
            
            <div class="mt-5 d-flex gap-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users text-info fa-lg me-2"></i>
                    <span class="text-light fw-bold">1,000+ Users</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-question-circle text-warning fa-lg me-2"></i>
                    <span class="text-light fw-bold">500+ Quizzes</span>
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block position-relative">
            <!-- Abstract 3D-like visual using CSS/SVG -->
            <div class="floating-animation position-relative z-1" style="transform-style: preserve-3d; perspective: 1000px;">
                <div class="card bg-dark border-0 shadow-lg p-3 mx-auto" style="width: 300px; transform: rotateY(-10deg) rotateX(5deg);">
                    <div class="card-body text-center">
                        <i class="fas fa-trophy fa-4x text-warning mb-3"></i>
                        <h5 class="text-light">Top Scorer</h5>
                        <p class="text-muted small">Achieve greatness</p>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="card bg-dark border-0 shadow-lg p-3 position-absolute" style="width: 260px; top: 150px; left: -40px; transform: rotateY(10deg) rotateZ(-5deg); z-index: -1; opacity: 0.8;">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success rounded-circle p-2 me-3">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-light mb-0">Quiz Passed</h6>
                            <small class="text-success">Score: 92%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Strip -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card h-100">
            <h2 class="display-4 fw-bold text-light mb-0">10k+</h2>
            <p class="text-primary fw-bold">Questions Answered</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card h-100">
            <h2 class="display-4 fw-bold text-light mb-0">98%</h2>
            <p class="text-success fw-bold">Satisfaction Rate</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card h-100">
            <h2 class="display-4 fw-bold text-light mb-0">50+</h2>
            <p class="text-info fw-bold">Categories</p>
        </div>
    </div>
</div>

<!-- Features Grid -->
<section class="py-5 text-center">
    <h2 class="display-5 fw-bold text-light mb-5">Why Choose QuizMaster?</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-bolt fa-2x text-warning"></i>
                    </div>
                    <h4 class="text-light mb-3">Instant Feedback</h4>
                    <p class="text-muted">Get detailed explanations and scores immediately after completing a quiz.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-chart-bar fa-2x text-info"></i>
                    </div>
                    <h4 class="text-light mb-3">Detailed Analytics</h4>
                    <p class="text-muted">Track your progress over time with comprehensive charts and performance reports.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-mobile-alt fa-2x text-success"></i>
                    </div>
                    <h4 class="text-light mb-3">Mobile Friendly</h4>
                    <p class="text-muted">Study on the go. Our platform is fully responsive and optimized for any device.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 text-center position-relative overflow-hidden rounded-4 my-5" style="background: var(--gradient-primary);">
    <div class="position-relative z-1">
        <h2 class="display-5 fw-bold text-white mb-4">Ready to start your journey?</h2>
        <p class="lead text-light mb-5 opacity-75">Join for free today and explore a world of knowledge.</p>
        <a href="register.php" class="btn btn-light btn-lg px-5 rounded-pill shadow fw-bold text-dark">Create Free Account</a>
    </div>
    <div class="hero-shape" style="width: 300px; height: 300px; top: -50px; left: -50px; background: rgba(255,255,255,0.1);"></div>
</section>

<style>
.floating-animation { animation: float 6s ease-in-out infinite; }
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
</style>

<?php include_once 'includes/footer.php'; ?>
