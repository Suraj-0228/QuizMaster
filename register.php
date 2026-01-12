<?php include_once 'controllers/register-process.php'; ?>

<div class="row min-vh-25 align-items-center py-5">
    
    <!-- Register Form Section -->
    <div class="col-lg-5 order-lg-1 mb-5 mb-lg-0">
        <div class="card glass-card border-0 shadow-lg position-relative overflow-hidden">
             <!-- Decorative -->
             <div class="position-absolute top-0 start-0 p-3 bg-gradient-accent opacity-10 rounded-bottom-end" style="border-bottom-right-radius: 50% !important; width: 100px; height: 100px;"></div>

            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-light">Create Account</h2>
                    <p class="text-muted small">Start your learning journey today</p>
                </div>

                <?php if (!isRegistrationAllowed()): ?>
                    <div class="text-center py-4">
                        <div class="mb-4">
                            <span class="d-inline-flex bg-danger bg-opacity-10 text-danger p-3 rounded-circle">
                                <i class="fas fa-user-slash fa-2x"></i>
                            </span>
                        </div>
                        <h4 class="text-light fw-bold">Registration Closed</h4>
                        <p class="text-muted">New account registration is currently disabled by the administrator.</p>
                        <a href="login.php" class="btn btn-outline-light rounded-pill px-4 mt-3">Back to Login</a>
                    </div>
                <?php else: ?>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger glass-alert mb-4 border-0 border-start border-danger border-4">
                        <ul class="mb-0 ps-3 small">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="premium-input-group mb-4">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="premium-control" id="username" name="username" placeholder=" " value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                        <label for="username">Choose Username</label>
                    </div>

                    <div class="premium-input-group mb-4">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="premium-control" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="premium-input-group mb-4">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="premium-control" id="password" name="password" placeholder=" ">
                        <i class="fas fa-eye password-toggle"></i>
                        <label for="password">Create Password</label>
                    </div>
                    
                    <div class="premium-input-group mb-4">
                        <i class="fas fa-check-circle input-icon"></i>
                        <input type="password" class="premium-control" id="confirm_password" name="confirm_password" placeholder=" ">
                        <i class="fas fa-eye password-toggle"></i>
                        <label for="confirm_password">Confirm Password</label>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-gradient-primary btn-lg rounded-pill shadow-lg hover-scale fw-bold">
                            Register <i class="fas fa-user-plus ms-2"></i>
                        </button>
                    </div>
                    <div class="text-center">
                        <p class="mb-0 text-muted small">Already have an account? <a href="login.php" class="text-primary fw-bold text-decoration-none">Login here</a></p>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Brand/Info Section -->
    <div class="col-lg-6 offset-lg-1 order-lg-2 d-none d-lg-block text-center position-relative">
        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 opacity-25" style="z-index: -1;">
             <div class="hero-shape" style="width: 500px; height: 500px; animation: float 7s ease-in-out infinite reverse; background: radial-gradient(circle at center, rgba(16, 185, 129, 0.2) 0%, rgba(13, 27, 42, 0) 70%);"></div>
        </div>
        <i class="fas fa-rocket fa-8x text-gradient mb-4"></i>
        <h1 class="display-3 fw-bold text-light mb-3">Join the <span class="text-gradient">Future</span></h1>
        <p class="lead text-muted mb-5">Join thousands of students mastering new skills every day.</p>
        
        <ul class="list-unstyled text-start d-inline-block mx-auto">
            <li class="mb-3 text-muted"><i class="fas fa-check-circle text-success me-2"></i> Free unlimited access to basic quizzes</li>
            <li class="mb-3 text-muted"><i class="fas fa-check-circle text-success me-2"></i> Track your progress with detailed analytics</li>
            <li class="mb-3 text-muted"><i class="fas fa-check-circle text-success me-2"></i> Compete on global leaderboards</li>
        </ul>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
