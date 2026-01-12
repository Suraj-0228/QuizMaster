<?php include_once 'controllers/reports-process.php'; ?>

<div class="container py-4">
    <!-- Hero Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="display-5 fw-bold text-light mb-2">Result Reports</h1>
            <p class="text-muted lead mb-0">Analytics and performance overview.</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-light d-print-none rounded-pill px-4">
            <i class="fas fa-print me-2"></i>Print Report
        </button>
    </div>

    <!-- Stats Dashboard -->
    <div class="row g-4 mb-5 d-print-none">
        <div class="col-md-4">
            <div class="glass-card border-0 shadow-sm p-4 text-center h-100">
                <div class="text-muted text-uppercase small mb-2">Total Attempts</div>
                <div class="display-4 fw-bold text-white mb-0"><?php echo $total_attempts; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card border-0 shadow-sm p-4 text-center h-100">
                <div class="text-muted text-uppercase small mb-2">Average Score</div>
                <div class="display-4 fw-bold text-info mb-0"><?php echo $avg_score; ?>%</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card border-0 shadow-sm p-4 text-center h-100">
                <div class="text-muted text-uppercase small mb-2">Pass Rate</div>
                <div class="display-4 fw-bold text-success mb-0"><?php echo $pass_rate; ?>%</div>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="glass-card border-0 shadow-lg position-relative overflow-hidden mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); color: var(--light-text);">
                    <thead class="bg-dark bg-opacity-50 border-bottom border-secondary border-opacity-25">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted small border-0">Student</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Quiz Title</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Score</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-center">Status</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-end pe-4">Date</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (count($attempts) > 0): ?>
                            <?php foreach($attempts as $attempt): ?>
                                <?php 
                                    $q_total = $attempt['total_questions'];
                                    $percentage = $q_total > 0 ? ($attempt['score'] / $q_total) * 100 : 0;
                                    $status = $percentage >= 50 ? 'Passed' : 'Failed';
                                    $status_class = $status === 'Passed' ? 'success' : 'danger';
                                    $bg_class = $status === 'Passed' ? 'bg-success' : 'bg-danger';
                                ?>
                                <tr class="border-bottom border-light border-opacity-10 transition-all">
                                    <td class="ps-4 py-3 fw-bold text-light">
                                        <?php echo sanitize($attempt['username']); ?>
                                    </td>
                                    <td class="py-3 text-muted">
                                        <?php echo sanitize($attempt['quiz_title']); ?>
                                    </td>
                                    <td class="py-3">
                                        <span class="fw-bold text-white"><?php echo $attempt['score']; ?>/<?php echo $q_total; ?></span>
                                        <small class="text-muted ms-1">(<?php echo round($percentage); ?>%)</small>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge <?php echo $bg_class; ?> bg-opacity-10 text-<?php echo $status_class; ?> border border-<?php echo $status_class; ?> border-opacity-25 rounded-pill px-3">
                                            <?php echo $status; ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4 py-3 text-muted small">
                                        <?php echo date('M d, Y H:i', strtotime($attempt['completed_at'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted opacity-50 mb-3"><i class="fas fa-chart-bar fa-3x"></i></div>
                                    <h5 class="text-light">No results found</h5>
                                    <p class="text-muted small">Students haven't completed any quizzes yet.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>
