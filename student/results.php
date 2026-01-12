<?php include_once '../controllers/results-process.php'; ?>

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
                <div class="position-relative d-inline-block mb-4 mt-3">
                    <div class="circular-chart-container">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg"
                                d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                            <path class="circle"
                                stroke-dasharray="<?php echo $percentage; ?>, 100"
                                stroke="<?php echo $passed ? '#10b981' : '#ef4444'; ?>"
                                d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                        </svg>
                        <div class="chart-content">
                            <div class="display-4 fw-bold text-light mb-0 tracking-tight"><?php echo round($percentage); ?>%</div>
                            <div class="small fw-bold text-uppercase tracking-wider <?php echo $passed ? 'text-success' : 'text-danger'; ?>">
                                <?php echo $passed ? 'PASSED' : 'FAILED'; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($passed): ?>
                    <h2 class="fw-bold text-light mb-3 animate-up">Excellent Job!</h2>
                    <p class="text-secondary mb-4 px-lg-5">You've mastered this topic with flying colors. Keep up the great work!</p>
                <?php else: ?>
                    <h2 class="fw-bold text-light mb-3 animate-up">Don't Give Up!</h2>
                    <p class="text-secondary mb-4 px-lg-5">Review your answers and try again to improve your score.</p>
                <?php endif; ?>
                
                <div class="row text-center mb-5 g-3">
                    <div class="col-4">
                        <div class="p-3 rounded-4 bg-dark-glass border border-secondary border-opacity-10 h-100">
                             <div class="text-primary mb-2"><i class="fas fa-clipboard-list fa-lg"></i></div>
                             <h4 class="text-light mb-0 fw-bold"><?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?></h4>
                             <small class="text-muted text-uppercase small-font">Score</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 rounded-4 bg-dark-glass border border-secondary border-opacity-10 h-100">
                             <div class="text-success mb-2"><i class="fas fa-check-circle fa-lg"></i></div>
                             <h4 class="text-light mb-0 fw-bold"><?php echo $attempt['correct_answers']; ?></h4>
                             <small class="text-muted text-uppercase small-font">Correct</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 rounded-4 bg-dark-glass border border-secondary border-opacity-10 h-100">
                             <div class="text-danger mb-2"><i class="fas fa-times-circle fa-lg"></i></div>
                             <h4 class="text-light mb-0 fw-bold"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></h4>
                             <small class="text-muted text-uppercase small-font">Wrong</small>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-3 col-lg-10 mx-auto">
                    <a href="review.php?attempt_id=<?php echo $attempt_id; ?>" class="btn btn-gradient-primary btn-lg rounded-pill shadow-lg hover-scale">
                        <span class="fw-bold">Review Answers</span> <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <div class="row g-3">
                        <div class="col-6">
                             <a href="quizzes.php" class="btn btn-outline-light w-100 rounded-pill py-2">Try Another</a>
                        </div>
                        <div class="col-6">
                             <a href="dashboard.php" class="btn btn-outline-light w-100 rounded-pill py-2">Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(27, 38, 59, 0.4);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
}
.bg-dark-glass {
    background: rgba(0, 0, 0, 0.2);
}
.tracking-wider { letter-spacing: 2px; }
.tracking-tight { letter-spacing: -1px; }
.small-font { font-size: 0.65rem; letter-spacing: 1px; }

/* Circular Chart */
.circular-chart-container {
    position: relative;
    width: 200px;
    height: 200px;
}
.circular-chart {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    max-height: 200px;
}
.circle-bg {
    fill: none;
    stroke: rgba(255, 255, 255, 0.05);
    stroke-width: 2.8;
}
.circle {
    fill: none;
    stroke-width: 2.8;
    stroke-linecap: round;
    transition: stroke-dasharray 1.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.chart-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
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
