<?php include_once 'controllers/login-process.php'; ?>

<div class="row min-vh-25 align-items-center py-5">
    <!-- Brand/Hero Section -->
    <div class="col-lg-6 d-none d-lg-block text-center position-relative">
        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 opacity-25" style="z-index: -1;">
            <div class="hero-shape" style="width: 500px; height: 500px; animation: float 6s ease-in-out infinite;"></div>
        </div>
        <i class="fas fa-microchip fa-8x text-gradient mb-4"></i>
        <h1 class="display-3 fw-bold text-light mb-3">Quiz<span class="text-gradient">Master</span></h1>
        <p class="lead text-muted mb-5">Unlock your potential with our adaptive learning platform.</p>
        
        <div class="d-flex justify-content-center gap-3">
            <div class="stat-card p-3" style="min-width: 150px;">
                <h3 class="text-light mb-0">1k+</h3>
                <small class="text-muted">Active Users</small>
            </div>
            <div class="stat-card p-3" style="min-width: 150px;">
                <h3 class="text-light mb-0">500+</h3>
                <small class="text-muted">Quizzes</small>
            </div>
        </div>
    </div>

    <!-- Login Form Section -->
    <div class="col-lg-5 offset-lg-1">
        <div class="card glass-card border-0 shadow-lg position-relative overflow-hidden">
             <!-- Decorative -->
             <div class="position-absolute top-0 end-0 p-3 bg-gradient-primary opacity-10 rounded-bottom-start"></div>

            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-light">Welcome Back</h2>
                    <p class="text-muted small">Please login to your account</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger glass-alert d-flex align-items-center mb-4 border-0 border-start border-danger border-4">
                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="premium-input-group mb-4">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" class="premium-control" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <label for="email">Email or Username</label>
                    </div>

                    <div class="premium-input-group mb-4">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="premium-control" id="password" name="password" placeholder=" ">
                        <i class="fas fa-eye password-toggle"></i>
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input bg-transparent border-secondary" type="checkbox" id="remember">
                            <label class="form-check-label text-muted small" for="remember">Remember me</label>
                        </div>
                        <a href="forgot-password.php" class="text-danger text-decoration-none small hover-glow">Forgot Password?</a>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-gradient-primary btn-lg rounded-pill shadow-lg hover-scale fw-bold">
                            Login <i class="fas fa-sign-in-alt ms-2"></i>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="mb-0 text-muted small">Don't have an account? <a href="register.php" class="text-primary fw-bold text-decoration-none">Register here</a></p>
                        
                        <div class="mt-4 pt-4 border-top border-secondary border-opacity-25">
                            <small class="text-muted d-block mb-2">Or continue with</small>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i class="fab fa-google"></i></a>
                                <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i class="fab fa-github"></i></a>
                                <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-3 text-center d-lg-none">
             <p class="text-muted small"><strong>Admin Demo:</strong> admin@quiz.com / admin123</p>
        </div>
    </div>
</div>

<style>
.social-btn {
    width: 40px; 
    height: 40px; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    border-color: rgba(255,255,255,0.1);
    color: #a0aec0;
}
.social-btn:hover {
    background: rgba(255,255,255,0.1);
    color: white;
    transform: translateY(-2px);
}
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
</style>

<?php include_once 'includes/footer.php'; ?>
