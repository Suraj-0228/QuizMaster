<?php include_once '../controllers/leaderboard-process.php'; ?>

<div class="row mb-5 text-center">
    <div class="col-12">
        <h1 class="display-5 fw-bold text-light mb-2">Global <span class="text-gradient">Leaderboard</span></h1>
        <p class="text-muted">Top performers competing for glory.</p>
    </div>
</div>

<!-- Podium Section -->
<?php if (count($top3) > 0): ?>
<div class="podium-container">
    
    <!-- 2nd Place -->
    <?php if (isset($top3[1])): $p2 = $top3[1]; ?>
    <div class="podium-card rank-2 shadow-lg">
        <div class="podium-avatar">
            <?php echo strtoupper(substr($p2['username'], 0, 1)); ?>
        </div>
        <h4 class="text-light fw-bold mb-1"><?php echo sanitize($p2['username']); ?></h4>
        <div class="badge bg-secondary mb-3">Rate: <?php echo round($p2['avg_accuracy']); ?>%</div>
        <h2 class="text-light fw-bold mb-0"><?php echo $p2['total_score']; ?> <span class="fs-6 text-muted">XP</span></h2>
        <div class="mt-auto text-uppercase tracking-wider small fw-bold text-secondary">2nd Place</div>
    </div>
    <?php endif; ?>

    <!-- 1st Place -->
    <?php if (isset($top3[0])): $p1 = $top3[0]; ?>
    <div class="podium-card rank-1 shadow-lg">
        <div class="crown-icon"><i class="fas fa-crown"></i></div>
        <div class="podium-avatar">
            <?php echo strtoupper(substr($p1['username'], 0, 1)); ?>
        </div>
        <h3 class="text-light fw-bold mb-1"><?php echo sanitize($p1['username']); ?></h3>
        <div class="badge bg-warning text-dark mb-3">Rate: <?php echo round($p1['avg_accuracy']); ?>%</div>
        <h1 class="text-warning fw-bold mb-0 display-4"><?php echo $p1['total_score']; ?> <span class="fs-6 text-muted">XP</span></h1>
        <div class="mt-auto text-uppercase tracking-wider small fw-bold text-warning">Champion</div>
    </div>
    <?php endif; ?>

    <!-- 3rd Place -->
    <?php if (isset($top3[2])): $p3 = $top3[2]; ?>
    <div class="podium-card rank-3 shadow-lg">
        <div class="podium-avatar">
            <?php echo strtoupper(substr($p3['username'], 0, 1)); ?>
        </div>
        <h4 class="text-light fw-bold mb-1"><?php echo sanitize($p3['username']); ?></h4>
        <div class="badge bg-secondary mb-3">Rate: <?php echo round($p3['avg_accuracy']); ?>%</div>
        <h2 class="text-light fw-bold mb-0"><?php echo $p3['total_score']; ?> <span class="fs-6 text-muted">XP</span></h2>
        <div class="mt-auto text-uppercase tracking-wider small fw-bold" style="color: #cd7f32;">3rd Place</div>
    </div>
    <?php endif; ?>

</div>
<?php else: ?>
    <div class="text-center py-5">
        <h4 class="text-muted">No records yet. Be the first!</h4>
        <a href="quizzes.php" class="btn btn-primary mt-3">Start a Quiz</a>
    </div>
<?php endif; ?>

<!-- Rankings List -->
<?php if (count($rest) > 0): ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h5 class="text-muted text-uppercase tracking-wider mb-4 ms-2">Honorable Mentions</h5>
        
        <?php foreach($rest as $idx => $user): ?>
            <div class="d-flex align-items-center p-3 mb-3 rounded-3 rank-item shadow-sm <?php echo ($user['id'] == $user_id) ? 'current-user-rank' : ''; ?>">
                <div class="fw-bold text-muted h4 mb-0 me-4" style="width: 40px; text-align: center;">
                    #<?php echo $idx + 4; ?>
                </div>
                
                <div class="rounded-circle bg-dark border border-secondary d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; flex-shrink: 0;">
                    <span class="fw-bold text-light"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                </div>
                
                <div class="flex-grow-1">
                    <h5 class="text-light mb-0"><?php echo sanitize($user['username']); ?></h5>
                    <small class="text-muted"><?php echo $user['quizzes_taken']; ?> Quizzes Taken</small>
                </div>
                
                <div class="text-end">
                    <h4 class="text-primary fw-bold mb-0"><?php echo $user['total_score']; ?></h4>
                    <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Total XP</small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Empty State Fix if only 1-2 users -->
<?php if (count($leaders) > 0 && count($leaders) < 3): ?>
    <div class="text-center mt-5">
        <p class="text-muted">More players needed to fill the podium!</p>
    </div>
<?php endif; ?>

<style>
.tracking-wider { letter-spacing: 2px; }
.text-gradient {
    background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>

<?php include_once '../includes/footer.php'; ?>
