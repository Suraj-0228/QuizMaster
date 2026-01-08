<div class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
    <a href="<?php echo base_url('admin/dashboard.php'); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fas fa-graduation-cap fa-2x me-2 text-primary"></i>
        <span class="fs-4 fw-bold">QuizMaster</span>
    </a>
    <hr class="border-secondary opacity-50">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?php echo base_url('admin/dashboard.php'); ?>" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" aria-current="page">
                <i class="fas fa-tachometer-alt me-2" style="width: 20px;"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/quizzes.php'); ?>" class="nav-link text-white <?php echo in_array(basename($_SERVER['PHP_SELF']), ['quizzes.php', 'add-quiz.php', 'edit-quiz.php', 'questions.php', 'add-question.php']) ? 'active' : ''; ?>">
                <i class="fas fa-book me-2" style="width: 20px;"></i>
                Quizzes
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/students.php'); ?>" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">
                <i class="fas fa-users me-2" style="width: 20px;"></i>
                Students
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/reports.php'); ?>" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar me-2" style="width: 20px;"></i>
                Reports
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/settings.php'); ?>" class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                <i class="fas fa-cog me-2" style="width: 20px;"></i>
                Settings
            </a>
        </li>
    </ul>
    <div class="mt-auto">
        <a href="<?php echo base_url('logout.php'); ?>" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center mb-4 hover-scale">
            <i class="fas fa-sign-out-alt me-2"></i> Log Out
        </a>
        
        <hr class="border-secondary opacity-50">
        
        <div class="d-flex align-items-center px-2">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; font-weight: bold;">
                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
            </div>
            <div>
                <div class="fw-bold small"><?php echo sanitize($_SESSION['username']); ?></div>
                <div class="text-muted" style="font-size: 0.75rem;">Administrator</div>
            </div>
        </div>
    </div>
</div>
