<?php include_once 'controllers/dash-process.php'; ?>

<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-light mb-2">Admin Dashboard</h1>
            <p class="text-muted lead mb-0">Overview of system performance and activity.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="add-quiz.php" class="btn btn-gradient-primary rounded-pill px-4 hover-scale">
                <i class="fas fa-plus me-2"></i>Create New Quiz
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card h-100 position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-center position-relative z-1">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-2">Total Students</h6>
                        <h2 class="text-light fw-bold mb-0"><?php echo $stats['students']; ?></h2>
                    </div>
                    <div class="feature-icon-wrapper bg-primary bg-opacity-10 text-primary mb-0">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card h-100 position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-center position-relative z-1">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-2">Active Quizzes</h6>
                        <h2 class="text-light fw-bold mb-0"><?php echo $stats['quizzes']; ?></h2>
                    </div>
                    <div class="feature-icon-wrapper bg-success bg-opacity-10 text-success mb-0">
                        <i class="fas fa-clipboard-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card h-100 position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-center position-relative z-1">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-2">Question Bank</h6>
                        <h2 class="text-light fw-bold mb-0"><?php echo $stats['questions']; ?></h2>
                    </div>
                    <div class="feature-icon-wrapper bg-warning bg-opacity-10 text-warning mb-0">
                        <i class="fas fa-database fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card h-100 position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-center position-relative z-1">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-2">Total Attempts</h6>
                        <h2 class="text-light fw-bold mb-0"><?php echo $stats['attempts']; ?></h2>
                    </div>
                    <div class="feature-icon-wrapper bg-info bg-opacity-10 text-info mb-0">
                        <i class="fas fa-history fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card stat-card border-0">
        <div class="card-header bg-transparent border-bottom border-light border-opacity-10 py-3 d-flex justify-content-between align-items-center">
            <h5 class="text-light mb-0"><i class="fas fa-clock me-2 text-primary"></i>Recent Student Activity</h5>
            <a href="reports.php" class="btn btn-sm btn-outline-light rounded-pill px-3">View All Report</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); color: var(--light-text);">
                    <thead class="bg-dark bg-opacity-50">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted small border-0">Student</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Quiz</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Score</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Date</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Status</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (count($recent_attempts) > 0): ?>
                            <?php foreach($recent_attempts as $attempt): ?>
                                <?php 
                                    $percentage = ($attempt['score'] / $attempt['total_questions']) * 100;
                                    $status_class = $percentage >= 50 ? 'success' : 'danger'; 
                                    $status_text = $percentage >= 50 ? 'Passed' : 'Failed';
                                    $status_icon = $percentage >= 50 ? 'check-circle' : 'times-circle';
                                ?>
                                <tr class="border-bottom border-light border-opacity-10">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-weight: bold; color: var(--light-text);">
                                                <?php echo strtoupper(substr($attempt['username'], 0, 1)); ?>
                                            </div>
                                            <span class="fw-bold"><?php echo sanitize($attempt['username']); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted"><?php echo sanitize($attempt['quiz_title']); ?></td>
                                    <td class="py-3">
                                        <span class="fw-bold text-light"><?php echo round($percentage); ?>%</span>
                                        <small class="text-muted ms-1">(<?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?>)</small>
                                    </td>
                                    <td class="py-3 text-muted small"><?php echo date('M d, H:i', strtotime($attempt['completed_at'])); ?></td>
                                    <td class="py-3">
                                        <span class="badge bg-<?php echo $status_class; ?> bg-opacity-10 text-<?php echo $status_class; ?> border border-<?php echo $status_class; ?> border-opacity-25 rounded-pill px-3">
                                            <i class="fas fa-<?php echo $status_icon; ?> me-1"></i><?php echo $status_text; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">No recent activity found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>

