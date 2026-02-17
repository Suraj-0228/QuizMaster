<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <i class="fas fa-graduation-cap me-2"></i>QuizMaster
        </a>
        
        <!-- Custom Toggler -->
        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('about.php'); ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('faq.php'); ?>">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contact.php'); ?>">Contact</a>
                </li>
            </ul>

            <!-- Right Side (User Auth) -->
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if(isLoggedIn()): ?>
                    <?php if(isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('admin/dashboard.php'); ?>">Admin Panel</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('student/dashboard.php'); ?>">Dashboard</a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-weight: bold;">
                                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                            </div>
                            <span class="d-none d-lg-inline"><?php echo sanitize($_SESSION['username']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="navbarDropdown">
                            <?php if(!isAdmin()): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('student/profile.php'); ?>"><i class="fas fa-user-cog me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('student/quizzes.php'); ?>"><i class="fas fa-list-check me-2"></i>My Quizzes</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('student/history.php'); ?>"><i class="fas fa-history me-2"></i>My History</a></li>
                                <li><hr class="dropdown-divider border-secondary my-1"></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/settings.php'); ?>"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider border-secondary my-1"></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('logout.php'); ?>"><i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="<?php echo base_url('login.php'); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4 rounded-pill" href="<?php echo base_url('register.php'); ?>">Sign Up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Tiny animation for dropdown */
.animated {
    animation-duration: 0.3s;
    animation-fill-mode: both;
}
.fadeIn {
    animation-name: fadeIn;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
