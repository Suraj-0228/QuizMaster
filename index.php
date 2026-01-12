<?php
$pageTitle = 'Home';
include_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-shape" style="top: -100px; right: -100px;"></div>
    <div class="hero-shape" style="bottom: -100px; left: -100px; width: 400px; height: 400px; background: radial-gradient(circle at center, rgba(16, 185, 129, 0.1) 0%, rgba(13, 27, 42, 0) 70%);"></div>
    
    <div class="row align-items-center ps-5">
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

<!-- Popular Categories -->
<section class="py-5 position-relative overflow-hidden">
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 opacity-20" style="background: radial-gradient(circle at center, rgba(65, 90, 119, 0.15) 0%, transparent 70%); z-index: -1;"></div>
    
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h6 class="text-primary text-uppercase fw-bold letter-spacing-2 mb-2">Explore</h6>
            <h2 class="display-5 fw-bold text-light mb-3">Popular Categories</h2>
            <p class="text-muted lead">Discover quizzes in our most trending topics</p>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Category 1: Programming -->
        <div class="col-md-6 col-lg-3">
            <div class="card glass-card h-100 hover-lift text-center p-4 border-0 position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-0 transition-all hover-opacity-10"></div>
                <div class="category-icon-wrapper mb-4 d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary" style="width: 80px; height: 80px;">
                    <i class="fas fa-code fa-3x"></i>
                </div>
                <h5 class="card-title text-light fw-bold mb-2">Programming</h5>
                <p class="card-text text-muted small mb-4">Master Python, Java, and more.</p>
                <a href="student/quizzes.php?category=programming" class="btn btn-sm btn-outline-primary rounded-pill px-4 stretched-link">Explore</a>
            </div>
        </div>
        
        <!-- Category 2: Science -->
        <div class="col-md-6 col-lg-3">
            <div class="card glass-card h-100 hover-lift text-center p-4 border-0 position-relative overflow-hidden">
                 <div class="position-absolute top-0 start-0 w-100 h-100 bg-success opacity-0 transition-all hover-opacity-10"></div>
                <div class="category-icon-wrapper mb-4 d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success" style="width: 80px; height: 80px;">
                    <i class="fas fa-flask fa-3x"></i>
                </div>
                <h5 class="card-title text-light fw-bold mb-2">Science</h5>
                <p class="card-text text-muted small mb-4">Physics, Chem, and Bio basics.</p>
                <a href="student/quizzes.php?category=science" class="btn btn-sm btn-outline-success rounded-pill px-4 stretched-link">Explore</a>
            </div>
        </div>
        
        <!-- Category 3: Mathematics -->
        <div class="col-md-6 col-lg-3">
            <div class="card glass-card h-100 hover-lift text-center p-4 border-0 position-relative overflow-hidden">
                 <div class="position-absolute top-0 start-0 w-100 h-100 bg-warning opacity-0 transition-all hover-opacity-10"></div>
                <div class="category-icon-wrapper mb-4 d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning" style="width: 80px; height: 80px;">
                    <i class="fas fa-calculator fa-3x"></i>
                </div>
                <h5 class="card-title text-light fw-bold mb-2">Mathematics</h5>
                <p class="card-text text-muted small mb-4">Algebra, Geometry, and Logic.</p>
                <a href="student/quizzes.php?category=math" class="btn btn-sm btn-outline-warning rounded-pill px-4 stretched-link">Explore</a>
            </div>
        </div>
        
        <!-- Category 4: History -->
        <div class="col-md-6 col-lg-3">
            <div class="card glass-card h-100 hover-lift text-center p-4 border-0 position-relative overflow-hidden">
                 <div class="position-absolute top-0 start-0 w-100 h-100 bg-info opacity-0 transition-all hover-opacity-10"></div>
                <div class="category-icon-wrapper mb-4 d-inline-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10 text-info" style="width: 80px; height: 80px;">
                    <i class="fas fa-globe-americas fa-3x"></i>
                </div>
                <h5 class="card-title text-light fw-bold mb-2">History</h5>
                <p class="card-text text-muted small mb-4">World events and civilizations.</p>
                <a href="student/quizzes.php?category=history" class="btn btn-sm btn-outline-info rounded-pill px-4 stretched-link">Explore</a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5 position-relative">    
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h6 class="text-info text-uppercase fw-bold letter-spacing-2 mb-2">Process</h6>
            <h2 class="display-5 fw-bold text-light mb-3">How It Works</h2>
            <p class="text-muted lead">Start your learning journey in simple steps</p>
        </div>
    </div>

    <div class="row g-4 position-relative px-lg-5">
        <!-- Step 1 -->
        <div class="col-md-4 text-center position-relative">
            <div class="step-connector"></div>
            <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-dark rounded-circle p-3 border border-dark-subtle">
                             <i class="fas fa-user-plus fa-2x text-light"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-dark">1</span>
                    </div>
                </div>
                <h4 class="text-white fw-bold mb-3">Sign Up</h4>
                <p class="text-muted">Create your free account in seconds. Join a community of eager learners.</p>
            </div>
        </div>
        
        <!-- Step 2 -->
        <div class="col-md-4 text-center position-relative">
            <div class="step-connector"></div>
             <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-dark rounded-circle p-3 border border-dark-subtle">
                             <i class="fas fa-tasks fa-2x text-light"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-dark">2</span>
                    </div>
                </div>
                <h4 class="text-white fw-bold mb-3">Take Quizzes</h4>
                <p class="text-muted">Choose from a variety of categories and challenge yourself with interactive quizzes.</p>
            </div>
        </div>
        
        <!-- Step 3 -->
        <div class="col-md-4 text-center position-relative">
             <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-dark rounded-circle p-3 border border-dark-subtle">
                             <i class="fas fa-trophy fa-2x text-light"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-dark">3</span>
                    </div>
                </div>
                <h4 class="text-white fw-bold mb-3">Get Results</h4>
                <p class="text-muted">Receive instant feedback, track your progress, and climb the leaderboard.</p>
            </div>
        </div>
    </div>
</section>

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

<!-- Testimonials -->
<section class="py-5 mb-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h6 class="text-warning text-uppercase fw-bold letter-spacing-2 mb-2">Testimonials</h6>
            <h2 class="display-5 fw-bold text-light mb-3">What Users Say</h2>
            <p class="text-muted lead">Join thousands of satisfied learners worldwide</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Testimonial 1 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-light fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"QuizMaster has transformed the way I revise for my exams. The instant feedback is incredibly helpful!"</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">JS</div>
                    <div>
                        <h6 class="text-white mb-0 fw-bold">John Smith</h6>
                        <small class="text-muted">Computer Science Student</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-light fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"The variety of categories keeps me engaged. I've learned so much about history and science just for fun."</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">ED</div>
                    <div>
                        <h6 class="text-white mb-0 fw-bold">Emily Davis</h6>
                        <small class="text-muted">Lifelong Learner</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 3 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-light fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"A fantastic platform! The interface is beautiful, and studying on my phone has never been easier."</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">MJ</div>
                    <div>
                        <h6 class="text-white mb-0 fw-bold">Michael Johnson</h6>
                        <small class="text-muted">Web Developer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
