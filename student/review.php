<?php include_once '../components/review-process.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Header & Nav -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-uppercase text-muted tracking-wider mb-1">Review Mode</h6>
                <h2 class="text-light mb-0"><?php echo sanitize($attempt['title']); ?></h2>
            </div>
            <div class="d-flex gap-2">
                <?php if(isAdmin()): ?>
                    <a href="../admin/student-details.php?id=<?php echo $attempt['user_id']; ?>" class="btn btn-outline-light rounded-pill px-4">Back to Student</a>
                <?php else: ?>
                    <a href="results.php?attempt_id=<?php echo $attempt_id; ?>" class="btn btn-outline-light rounded-pill px-4">Results</a>
                    <a href="dashboard.php" class="btn btn-outline-light rounded-pill px-4">Dashboard</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="card border-0 shadow-lg mb-5 glass-card overflow-hidden">
            <div class="card-body p-4">
                <div class="row text-center align-items-center">
                    <div class="col-md-3 border-end border-secondary border-opacity-25 relative">
                        <small class="text-muted text-uppercase fw-bold">Score</small>
                        <h3 class="text-light display-6 fw-bold mb-0"><?php echo $attempt['score']; ?> <span class="text-muted fs-6">/ <?php echo $attempt['total_questions']; ?></span></h3>
                    </div>
                    <div class="col-md-3 border-end border-secondary border-opacity-25">
                        <small class="text-muted text-uppercase fw-bold">Percentage</small>
                        <?php 
                            $percentage = ($attempt['total_questions'] > 0) ? ($attempt['score'] / $attempt['total_questions']) * 100 : 0;
                            $passed = $percentage >= $attempt['passing_score'];
                        ?>
                        <h3 class="<?php echo $passed ? 'text-success' : 'text-danger'; ?> display-6 fw-bold mb-0">
                            <?php echo round($percentage); ?>%
                        </h3>
                    </div>
                    <div class="col-md-3 border-end border-secondary border-opacity-25">
                        <small class="text-muted text-uppercase fw-bold">Correct</small>
                        <h3 class="text-success display-6 fw-bold mb-0"><?php echo $attempt['correct_answers']; ?></h3>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted text-uppercase fw-bold">Incorrect</small>
                        <h3 class="text-danger display-6 fw-bold mb-0"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions List -->
        <?php foreach($questions as $index => $q): ?>
            <div class="card mb-4 border-0 shadow-sm glass-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="text-light lh-base">
                            <span class="badge bg-secondary me-2 rounded-pill">Q<?php echo $index + 1; ?></span>
                            <?php echo sanitize($q['question_text']); ?>
                        </h5>
                        <?php if($q['user_is_correct']): ?>
                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2">
                                <i class="fas fa-check me-1"></i> Correct
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-2">
                                <i class="fas fa-times me-1"></i> Incorrect
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="ms-lg-4 ps-lg-3">
                        <div class="p-3 rounded-3 mb-3 <?php echo $q['user_is_correct'] ? 'bg-success-subtle border border-success border-opacity-25' : 'bg-danger-subtle border border-danger border-opacity-25'; ?>">
                            <p class="mb-1 text-muted small text-uppercase fw-bold">Your Answer</p>
                            <div class="<?php echo $q['user_is_correct'] ? 'text-success' : 'text-danger'; ?> fw-semibold">
                                <?php if($q['selected_option_id']): ?>
                                    <?php echo sanitize($q['user_answer_text']); ?>
                                <?php else: ?>
                                    <em class="text-muted opacity-75">No answer selected</em>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if(!$q['user_is_correct']): ?>
                            <div class="p-3 rounded-3 bg-dark-glass border border-success border-opacity-25">
                                <p class="mb-1 text-muted small text-uppercase fw-bold">Correct Answer</p>
                                <?php 
                                    $stmt_c = $pdo->prepare("SELECT option_text FROM options WHERE question_id = ? AND is_correct = 1");
                                    $stmt_c->execute([$q['id']]);
                                    $correct_opt = $stmt_c->fetch();
                                ?>
                                <div class="text-success fw-bold">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <?php echo $correct_opt ? sanitize($correct_opt['option_text']) : 'N/A'; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
</div>

<style>
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}
.bg-dark-glass {
    background: rgba(13, 27, 42, 0.3);
}
.tracking-wider { letter-spacing: 1.5px; }
.bg-success-subtle { background-color: rgba(16, 185, 129, 0.1); }
.bg-danger-subtle { background-color: rgba(239, 68, 68, 0.1); }
</style>

<?php include_once '../includes/footer.php'; ?>
