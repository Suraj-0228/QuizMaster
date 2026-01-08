<?php include_once 'components/details.php'; ?>

<div class="container py-4">
    <!-- Back Navigation -->
    <div class="mb-4">
        <a href="students.php" class="btn btn-outline-light btn-sm rounded-pill px-3 opacity-75 hover-opacity-100">
            <i class="fas fa-arrow-left me-2"></i>Back to Students
        </a>
    </div>

    <div class="row g-4">
        <!-- Student Profile Card -->
        <div class="col-lg-4">
            <div class="glass-card border-0 shadow-lg h-100 position-relative overflow-hidden">
                <div class="card-body p-4 text-center position-relative z-1">
                    <div class="mb-4">
                        <div class="rounded-circle bg-gradient-primary d-inline-flex align-items-center justify-content-center shadow-lg" style="width: 120px; height: 120px; font-size: 3rem;">
                            <span class="fw-bold text-white"><?php echo strtoupper(substr($student['username'], 0, 1)); ?></span>
                        </div>
                    </div>
                    
                    <h3 class="text-light fw-bold mb-1"><?php echo sanitize($student['username']); ?></h3>
                    <p class="text-muted mb-4"><i class="fas fa-envelope me-2 small"></i><?php echo sanitize($student['email']); ?></p>
                    
                    <div class="row g-3 text-start">
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 h-100">
                                <div class="text-muted small text-uppercase mb-1">Quizzes</div>
                                <div class="h3 mb-0 text-light fw-bold"><?php echo count($attempts); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 h-100">
                                <div class="text-muted small text-uppercase mb-1">Joined</div>
                                <div class="h5 mb-0 text-light fw-bold"><?php echo date('M Y', strtotime($student['created_at'])); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative BG -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-b from-primary to-transparent opacity-5 z-0" style="pointer-events: none;"></div>
            </div>
        </div>
        
        <!-- Quiz History -->
        <div class="col-lg-8">
            <div class="glass-card border-0 shadow-lg h-100 position-relative overflow-hidden">
                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-light fw-bold"><i class="fas fa-history me-2 text-primary"></i> Quiz History</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); color: var(--light-text);">
                            <thead class="bg-dark bg-opacity-50 border-bottom border-secondary border-opacity-25">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted small border-0">Quiz Title</th>
                                    <th class="py-3 text-uppercase text-muted small border-0">Date Taken</th>
                                    <th class="py-3 text-uppercase text-muted small border-0">Score</th>
                                    <th class="py-3 text-uppercase text-muted small border-0 text-center">Result</th>
                                    <th class="py-3 text-uppercase text-muted small border-0 text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                <?php if (count($attempts) > 0): ?>
                                    <?php foreach($attempts as $attempt): ?>
                                        <?php 
                                            $total_questions = $attempt['quiz_total']; // Using the subquery alias
                                            $percentage = $total_questions > 0 ? ($attempt['score'] / $total_questions) * 100 : 0;
                                            $passed = $percentage >= 50; 
                                        ?>
                                        <tr class="border-bottom border-light border-opacity-10 transition-all">
                                            <td class="ps-4 py-3 fw-bold text-light">
                                                <?php echo sanitize($attempt['title']); ?>
                                            </td>
                                            <td class="py-3 text-muted">
                                                <?php echo date('M d, Y H:i', strtotime($attempt['started_at'])); ?>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <span class="fw-bold text-light me-2"><?php echo $attempt['score']; ?>/<?php echo $total_questions; ?></span>
                                                    <small class="text-muted">(<?php echo round($percentage); ?>%)</small>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center">
                                                <?php if($passed): ?>
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">Passed</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3">Failed</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end pe-4 py-3">
                                                <a href="../student/review.php?attempt_id=<?php echo $attempt['id']; ?>" class="btn btn-icon btn-sm btn-outline-info rounded-circle border-0 bg-transparent opacity-75 hover-opacity-100" title="Review Attempt">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted opacity-50 mb-3"><i class="fas fa-clipboard-list fa-3x"></i></div>
                                            <h5 class="text-light">No quiz attempts yet</h5>
                                            <p class="text-muted small">This student hasn't taken any quizzes.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>
