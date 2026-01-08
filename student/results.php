<?php include_once '../components/results-process.php'; ?>

<div class="row justify-content-center position-relative">
    <?php if($passed): ?>
        <canvas id="confetti" class="position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none; z-index: 999;"></canvas>
    <?php endif; ?>

    <div class="col-md-8 col-lg-6 text-center">
        <div class="card border-0 shadow-lg mb-5 glass-card overflow-hidden">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="text-uppercase tracking-wider text-muted small mb-1">Quiz Results</h5>
                <h3 class="text-light mb-0"><?php echo sanitize($attempt['title']); ?></h3>
            </div>
            
            <div class="card-body p-5">
                <!-- Circular Progress Bar -->
                <div class="position-relative d-inline-block mb-4">
                    <svg class="circular-chart" viewBox="0 0 36 36" width="180" height="180">
                        <path class="circle-bg"
                            d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                        <path class="circle"
                            stroke-dasharray="<?php echo $percentage; ?>, 100"
                            stroke="<?php echo $circle_color; ?>"
                            d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                        />
                    </svg>
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                        <div class="display-5 fw-bold text-light" style="line-height: 1;"><?php echo round($percentage); ?>%</div>
                        <div class="small text-muted text-uppercase fw-bold"><?php echo $passed ? 'Passed' : 'Failed'; ?></div>
                    </div>
                </div>

                <?php if ($passed): ?>
                    <h2 class="fw-bold text-success mb-3 animate-up">Excellent Job!</h2>
                    <p class="text-muted mb-4">You've mastered this topic. Keep up the great work!</p>
                <?php else: ?>
                    <h2 class="fw-bold text-danger mb-3 animate-up">Don't Give Up!</h2>
                    <p class="text-muted mb-4">Review your answers and try again to improve your score.</p>
                <?php endif; ?>
                
                <div class="row text-center mb-5 g-0 rounded-4 bg-dark-glass p-3 border border-secondary border-opacity-25">
                    <div class="col-4 border-end border-secondary border-opacity-25">
                        <h4 class="text-light mb-0 fw-bold"><?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?></h4>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Score</small>
                    </div>
                    <div class="col-4 border-end border-secondary border-opacity-25">
                        <h4 class="text-success mb-0 fw-bold"><?php echo $attempt['correct_answers']; ?></h4>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Correct</small>
                    </div>
                    <div class="col-4">
                        <h4 class="text-danger mb-0 fw-bold"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></h4>
                        <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Wrong</small>
                    </div>
                </div>
                
                <div class="d-grid gap-3">
                    <a href="review.php?attempt_id=<?php echo $attempt_id; ?>" class="btn btn-primary btn-lg rounded-pill shadow-lg">
                        <i class="fas fa-search me-2"></i>Review Detailed Answers
                    </a>
                    <div class="d-flex gap-3">
                        <a href="quizzes.php" class="btn btn-outline-light flex-grow-1 rounded-pill">Take Another Quiz</a>
                        <a href="dashboard.php" class="btn btn-outline-light flex-grow-1 rounded-pill">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}
.bg-dark-glass {
    background: rgba(13, 27, 42, 0.4);
}
.tracking-wider { letter-spacing: 2px; }

/* Circular Chart */
.circular-chart {
    display: block;
    margin: 0 auto;
    max-width: 80%;
    max-height: 250px;
}
.circle-bg {
    fill: none;
    stroke: #2c3e50;
    stroke-width: 2.5;
}
.circle {
    fill: none;
    stroke-width: 2.5;
    stroke-linecap: round;
    transition: stroke-dasharray 1s ease-out; /* Animation */
}
.animate-up {
    animation: fadeInUp 0.8s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<?php if($passed): ?>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    // Celebration Confetti
    var duration = 3 * 1000;
    var animationEnd = Date.now() + duration;
    var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

    function random(min, max) {
      return Math.random() * (max - min) + min;
    }

    var interval = setInterval(function() {
      var timeLeft = animationEnd - Date.now();

      if (timeLeft <= 0) {
        return clearInterval(interval);
      }

      var particleCount = 50 * (timeLeft / duration);
      // since particles fall down, start a bit higher than random
      confetti(Object.assign({}, defaults, { particleCount, origin: { x: random(0.1, 0.3), y: Math.random() - 0.2 } }));
      confetti(Object.assign({}, defaults, { particleCount, origin: { x: random(0.7, 0.9), y: Math.random() - 0.2 } }));
    }, 250);
</script>
<?php endif; ?>

<?php include_once '../includes/footer.php'; ?>
