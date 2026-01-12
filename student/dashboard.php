<?php include_once '../controllers/dashboard-process.php'; ?>

<!-- Welcome Banner -->
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <h1 class="display-5 fw-bold text-light mb-2">Welcome back, <span class="text-gradient"><?php echo sanitize($_SESSION['username']); ?></span>!</h1>
        <p class="text-muted lead">Ready to continue your learning journey?</p>
    </div>
    <div class="col-md-4 text-md-end">
        <span class="badge bg-dark-custom border border-secondary p-3 rounded-pill text-light">
            <i class="fas fa-calendar-alt me-2 text-primary"></i> <?php echo date('l, F j, Y'); ?>
        </span>
    </div>
</div>

<!-- Stats Grid -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card h-100 position-relative overflow-hidden">
            <div class="position-relative z-1">
                <div class="feature-icon-wrapper mb-3">
                    <i class="fas fa-trophy fa-2x text-warning"></i>
                </div>
                <h2 class="display-4 fw-bold text-light mb-0"><?php echo $total_attempts; ?></h2>
                <p class="text-muted mb-0">Quizzes Completed</p>
            </div>
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="fas fa-trophy fa-5x text-warning"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card h-100 position-relative overflow-hidden">
            <div class="position-relative z-1">
                <div class="feature-icon-wrapper mb-3">
                    <i class="fas fa-chart-line fa-2x text-info"></i>
                </div>
                <h2 class="display-4 fw-bold text-light mb-0"><?php echo $avg_score; ?>%</h2>
                <p class="text-muted mb-0">Average Score</p>
            </div>
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="fas fa-chart-line fa-5x text-info"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card h-100 position-relative overflow-hidden">
            <div class="position-relative z-1">
                <div class="feature-icon-wrapper mb-3">
                    <i class="fas fa-star fa-2x text-primary"></i>
                </div>
                <h2 class="display-4 fw-bold text-light mb-0"><?php echo $total_attempts * 10; ?></h2>
                <p class="text-muted mb-0">Total XP</p>
            </div>
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="fas fa-star fa-5x text-primary"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Activity -->
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-light fw-bold mb-0">
                <i class="fas fa-history me-2 text-primary"></i>Recent Activity
            </h4>
            <a href="history.php" class="btn btn-sm btn-outline-light rounded-pill px-3 transition-all hover-scale">View All</a>
        </div>

        <?php if (count($recent_history) > 0): ?>
            <div class="activity-feed">
                <?php foreach($recent_history as $history): ?>
                    <?php 
                        $score_pct = ($history['total_questions'] > 0) ? ($history['score'] / $history['total_questions']) : 0;
                        $is_passed = $score_pct >= 0.5; // Assuming 50% pass
                        $pct_value = round($score_pct * 100);
                        $status_color = $is_passed ? 'success' : 'danger';
                    ?>
                    <div class="card glass-card border-0 mb-3 activity-card overflow-hidden">
                        <div class="status-indicator bg-<?php echo $status_color; ?>"></div>
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="activity-icon bg-<?php echo $status_color; ?> bg-opacity-10 text-<?php echo $status_color; ?>">
                                        <i class="fas <?php echo $is_passed ? 'fa-check' : 'fa-times'; ?>"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-light mb-1 fw-bold"><?php echo sanitize($history['title']); ?></h5>
                                        <div class="d-flex align-items-center text-muted small">
                                            <span class="me-3"><i class="far fa-clock me-1"></i> <?php echo date('M d, h:i A', strtotime($history['completed_at'])); ?></span>
                                            <span><i class="fas fa-hourglass-half me-1"></i> <?php echo $history['time_limit']; ?>m</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-end d-flex flex-column align-items-end">
                                    <span class="display-6 fw-bold text-<?php echo $status_color; ?> mb-0" style="font-size: 1.8rem;">
                                        <?php echo $pct_value; ?>%
                                    </span>
                                    <a href="review.php?attempt_id=<?php echo $history['id']; ?>" class="btn btn-sm btn-link text-decoration-none text-muted p-0 mt-1 hover-light">
                                        Review <i class="fas fa-chevron-right ms-1" style="font-size: 0.8em;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card glass-card border-0 shadow-lg text-center py-5">
                <div class="card-body">
                    <div class="bg-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-clipboard-list fa-3x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-light">No Recent Activity</h4>
                    <p class="text-muted mb-4">You haven't taken any quizzes yet. Start your journey now!</p>
                    <a href="quizzes.php" class="btn btn-primary rounded-pill px-4 shadow-sm hover-scale">
                        Browse Quizzes
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <!-- Leaderboard Card -->
        <div class="card border-0 shadow-lg mb-4 glass-card overflow-hidden">
             <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="fas fa-crown fa-2x text-warning"></i>
                </div>
                <div>
                    <h5 class="text-light mb-1">Leaderboard</h5>
                    <p class="text-muted small mb-0">See where you rank!</p>
                </div>
                <a href="leaderboard.php" class="btn btn-outline-warning rounded-pill ms-auto btn-sm">View</a>
            </div>
        </div>

        <div class="card border-0 shadow-lg overflow-hidden position-relative mb-4">
            <div class="card-body p-4 text-center">
                <div class="hero-shape position-absolute" style="width: 150px; height: 150px; top: -50px; right: -50px; background: rgba(var(--primary-rgb), 0.2);"></div>
                <i class="fas fa-rocket fa-3x text-primary mb-3 text-gradient"></i>
                <h4 class="text-light">Start New Quiz</h4>
                <p class="text-muted mb-4">Challenge yourself with a new topic.</p>
                <a href="quizzes.php" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Browse Library</a>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <h5 class="text-light mb-4">My Progress</h5>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Quiz Completion</span>
                        <span class="text-info small">Hardcoded 75%</span>
                    </div>
                    <div class="progress bg-dark" style="height: 6px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Accuracy</span>
                        <span class="text-success small"><?php echo $avg_score; ?>%</span>
                    </div>
                    <div class="progress bg-dark" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $avg_score; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-success-subtle { background-color: rgba(16, 185, 129, 0.2); }
.bg-danger-subtle { background-color: rgba(239, 68, 68, 0.2); }
.hover-bg-dark:hover { background-color: rgba(255, 255, 255, 0.05) !important; }
.transition-all { transition: all 0.2s ease; }

/* Activity Card Styles */
.activity-card {
    position: relative;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background: rgba(27, 38, 59, 0.5); /* Slightly lighter/transparent than standard glass for stacking */
}
.activity-card:hover {
    transform: translateX(5px);
    background: rgba(27, 38, 59, 0.8);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
}
.status-indicator {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}
.activity-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.hover-light:hover { color: #fff !important; }
.hover-scale:hover { transform: scale(1.05); }
</style>

<?php include_once '../includes/footer.php'; ?>
