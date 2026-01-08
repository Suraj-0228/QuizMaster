<?php
$pageTitle = 'About Us';
include_once 'includes/header.php';
?>

<!-- Hero Section -->
<div class="row align-items-center mb-5 py-5">
    <div class="col-lg-7">
        <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill px-3 py-2 mb-3">
             <i class="fas fa-rocket me-2"></i> Est. 2024
        </span>
        <h1 class="display-3 fw-bold text-light mb-4">Empowering <span class="text-gradient">Knowledge</span> Through Innovation</h1>
        <p class="lead text-muted mb-4">
            QuizMaster isn't just a platform; it's a movement to make learning measurable, interactive, and universally accessible. We bridge the gap between curiosity and mastery.
        </p>
        <div class="d-flex gap-3">
            <a href="register.php" class="btn btn-primary rounded-pill px-4 shadow-sm">Join Our Mission</a>
            <a href="contact.php" class="btn btn-outline-light rounded-pill px-4">Contact Us</a>
        </div>
    </div>
    <div class="col-lg-5 text-center d-none d-lg-block">
        <div class="position-relative">
            <div class="hero-shape bg-primary opacity-10 rounded-circle position-absolute top-50 start-50 translate-middle" style="width: 400px; height: 400px; filter: blur(80px);"></div>
            <i class="fas fa-layer-group fa-10x text-light opacity-25 position-relative z-1"></i>
        </div>
    </div>
</div>

<!-- Mission Section -->
<div class="row justify-content-center mb-5">
    <div class="col-lg-10">
        <div class="card glass-card border-0 shadow-lg position-relative overflow-hidden">
             <div class="position-absolute top-0 end-0 p-3 p-md-5 opacity-10">
                <i class="fas fa-quote-right fa-8x text-light mission-quote"></i>
            </div>
            <div class="card-body p-5 position-relative z-1">
                <h3 class="text-light fw-bold mb-4">Our Mission</h3>
                <p class="text-light fs-5 lh-lg mb-0" style="opacity: 0.9;">
                    "To provide a seamless and engaging assessment ecosystem where students can challenge themselves, educators can track real progress, and knowledge knows no boundaries. We believe that every quiz attempted is a step closer to excellence."
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Values Grid -->
<div class="row g-4 mb-5 pt-4">
    <div class="col-12 text-center mb-2">
        <h2 class="text-light fw-bold">Why Choose QuizMaster?</h2>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow glass-card hover-lift transition-all">
            <div class="card-body text-center p-4">
                <div class="bg-dark-glass rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-brain fa-3x text-info"></i>
                </div>
                <h4 class="text-light mb-3">Adaptive Learning</h4>
                <p class="text-muted small">
                    Our intelligent system adapts to your performance, offering challenges that help you grow at your own unique pace.
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow glass-card hover-lift transition-all">
            <div class="card-body text-center p-4">
                <div class="bg-dark-glass rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-globe-americas fa-3x text-warning"></i>
                </div>
                <h4 class="text-light mb-3">Global Community</h4>
                <p class="text-muted small">
                    Connect with thousands of learners worldwide. Compete on global leaderboards and share your achievements.
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow glass-card hover-lift transition-all">
            <div class="card-body text-center p-4">
                <div class="bg-dark-glass rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-chart-pie fa-3x text-success"></i>
                </div>
                <h4 class="text-light mb-3">Deep Analytics</h4>
                <p class="text-muted small">
                    Visualize your learning journey with detailed performance graphs, accuracy metrics, and historical trends.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Team/Stats Strip -->
<div class="row mb-5">
    <div class="col-12">
        <div class="py-5 border-top border-bottom border-secondary border-opacity-25">
             <div class="row text-center">
                 <div class="col-md-4 mb-4 mb-md-0">
                     <h2 class="display-4 fw-bold text-light mb-0">50+</h2>
                     <p class="text-uppercase text-muted tracking-wider small">Quizzes Available</p>
                 </div>
                 <div class="col-md-4 mb-4 mb-md-0">
                     <h2 class="display-4 fw-bold text-light mb-0">1k+</h2>
                     <p class="text-uppercase text-muted tracking-wider small">Active Students</p>
                 </div>
                 <div class="col-md-4">
                     <h2 class="display-4 fw-bold text-light mb-0">99%</h2>
                     <p class="text-uppercase text-muted tracking-wider small">Satisfaction Rate</p>
                 </div>
             </div>
        </div>
    </div>
</div>

<style>
.bg-primary-subtle { background-color: rgba(65, 90, 119, 0.2); }
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}
.hover-lift:hover {
    transform: translateY(-5px);
    background: rgba(27, 38, 59, 0.8);
}
.transition-all { transition: all 0.3s ease; }
.tracking-wider { letter-spacing: 2px; }
.bg-dark-glass { background: rgba(0,0,0,0.3); }

@media (max-width: 768px) {
    .mission-quote { font-size: 4rem !important; }
}
</style>

<?php include_once 'includes/footer.php'; ?>
