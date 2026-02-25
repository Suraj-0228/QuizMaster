<?php include_once '../controllers/history-process.php'; ?>

<div class="row mb-5">
    <div class="col-md-8">
        <h1 class="display-5 fw-bold text-light">Learning <span class="text-gradient">Timeline</span></h1>
        <p class="text-muted">A journey of your achievements and attempts.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="quizzes.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i>New Attempt
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <?php if (count($history) > 0): ?>
            <div class="timeline mt-4">
                <?php foreach($history as $index => $item): ?>
                    <?php 
                        $percentage = ($item['total_questions'] > 0) ? ($item['score'] / $item['total_questions']) * 100 : 0;
                        $passed = $percentage >= $item['passing_score'];
                        $statusClass = $passed ? 'success' : 'fail';
                    ?>
                    
                    <div class="timeline-item <?php echo $statusClass; ?>">
                        <div class="timeline-dot"></div>
                        <div class="timeline-date d-none d-md-block">
                            <?php echo date('M d, Y', strtotime($item['completed_at'])); ?>
                            <br>
                            <small class="text-muted"><?php echo date('h:i A', strtotime($item['completed_at'])); ?></small>
                        </div>
                        
                        <!-- Mobile Date (visible only on small screens) -->
                        <div class="d-md-none text-muted small mb-2">
                             <i class="far fa-clock me-1"></i> <?php echo date('M d, Y • h:i A', strtotime($item['completed_at'])); ?>
                        </div>

                        <div class="card glass-card border-0 shadow-sm hover-lift transition-all">
                            <div class="card-body p-4">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <?php if($passed): ?>
                                                <span class="badge bg-success-subtle text-success border border-success rounded-pill px-2 py-1 me-2">
                                                    <i class="fas fa-check-circle"></i> Passed
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-2 py-1 me-2">
                                                    <i class="fas fa-times-circle"></i> Failed
                                                </span>
                                            <?php endif; ?>
                                            <small class="text-muted">Score: <?php echo $item['score']; ?>/<?php echo $item['total_questions']; ?></small>
                                        </div>
                                        <h4 class="text-light mb-1"><?php echo sanitize($item['title']); ?></h4>
                                        <div class="progress bg-dark mt-2" style="height: 6px; width: 100px;">
                                            <div class="progress-bar <?php echo $passed ? 'bg-success' : 'bg-danger'; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-md-end d-flex d-md-block align-items-center justify-content-between gap-3">
                                        <div class="mb-md-2">
                                            <h3 class="<?php echo $passed ? 'text-success' : 'text-danger'; ?> fw-bold mb-0"><?php echo round($percentage); ?>%</h3>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <?php if ($percentage >= 75): ?>
                                            <a href="download-certificate.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-warning rounded-pill" title="Download Certificate" target="_blank">
                                                <i class="fas fa-award"></i>
                                            </a>
                                            <?php endif; ?>
                                            
                                            <a href="results.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-light rounded-pill" title="View Result">
                                                <i class="fas fa-chart-bar"></i>
                                            </a>
                                            <a href="review.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary rounded-pill px-3">
                                                Review
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-history fa-4x text-muted mb-3 opacity-25"></i>
                <h3 class="text-light">No attempts yet</h3>
                <p class="text-muted">Your journey begins with a single step.</p>
                <a href="quizzes.php" class="btn btn-gradient-primary rounded-pill px-5 mt-3 shadow">
                    Browse Quizzes
                </a>
            </div>
        <?php endif; ?>
</div>
</div>

<style>
.bg-success-subtle { background-color: rgba(16, 185, 129, 0.1); }
.bg-danger-subtle { background-color: rgba(239, 68, 68, 0.1); }
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}
.hover-lift:hover {
    transform: translateY(-3px);
    border-color: rgba(119, 141, 169, 0.3);
    background: rgba(27, 38, 59, 0.8);
}
.transition-all { transition: all 0.3s ease; }
</style>

<?php include_once '../includes/footer.php'; ?>
