<?php include_once '../controllers/take-quiz-process.php'; ?>

<!-- Sticky Header info bar -->
<div class="sticky-top bg-dark-glass border-bottom border-secondary mb-4 py-3 shadow-sm" style="top: 70px; z-index: 900;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 text-light d-none d-md-block"><?php echo sanitize($quiz['title']); ?></h5>
                <small class="text-muted d-md-none">Question Progress</small>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="fas fa-question-circle me-1"></i> <?php echo count($questions); ?> Questions
                </span>
                
                <?php if($quiz['time_limit'] > 0): ?>
                    <div class="timer-badge d-flex align-items-center px-3 py-2 rounded-pill bg-warning text-dark fw-bold">
                        <i class="fas fa-clock me-2"></i>
                        <span id="time-remaining" style="min-width: 45px;"><?php echo $quiz['time_limit']; ?>:00</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <form action="" method="POST" id="quizForm">
            <?php foreach($questions as $index => $q): ?>
                <div class="card mb-5 border-0 shadow-lg glass-card position-relative overflow-hidden" id="q_<?php echo $q['id']; ?>">
                    <div class="position-absolute top-0 start-0 w-100 bg-gradient-primary" style="height: 4px;"></div>
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex mb-4">
                            <span class="display-4 text-muted opacity-25 me-3" style="line-height: 1;">
                                <?php echo sprintf("%02d", $index + 1); ?>
                            </span>
                            <h4 class="card-title text-light mb-0 pt-2" style="line-height: 1.4;">
                                <?php echo sanitize($q['question_text']); ?>
                            </h4>
                        </div>
                        
                        <?php 
                            $opt_stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ? ORDER BY RAND()");
                            $opt_stmt->execute([$q['id']]);
                            $options = $opt_stmt->fetchAll();
                        ?>
                        
                        <div class="options-grid">
                            <?php foreach($options as $opt): ?>
                                <div class="option-item">
                                    <input class="option-input" type="radio" name="answers[<?php echo $q['id']; ?>]" id="opt_<?php echo $opt['id']; ?>" value="<?php echo $opt['id']; ?>">
                                    <label class="option-label" for="opt_<?php echo $opt['id']; ?>">
                                        <div class="check-circle"></div>
                                        <span class="option-text"><?php echo sanitize($opt['option_text']); ?></span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="d-grid mb-5 pb-5">
                <button type="submit" class="btn btn-gradient-primary btn-lg py-3 rounded-pill shadow-lg text-uppercase fw-bold tracking-wider">
                    Submit Quiz <i class="fas fa-paper-plane ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Glass Effect */
.bg-dark-glass {
    background-color: rgba(13, 27, 42, 0.95);
    backdrop-filter: blur(10px);
}
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}

/* Options Styling */
.options-grid {
    display: grid;
    gap: 15px;
}
.option-item {
    position: relative;
}
.option-input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
.option-label {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    background: rgba(13, 27, 42, 0.5);
    border: 2px solid rgba(119, 141, 169, 0.2);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.option-label:hover {
    background: rgba(65, 90, 119, 0.2);
    border-color: var(--dusk-blue);
}
.option-input:checked + .option-label {
    background: rgba(65, 90, 119, 0.3);
    border-color: var(--primary);
    box-shadow: 0 0 15px rgba(65, 90, 119, 0.2);
}

/* Custom Radio Circle */
.check-circle {
    width: 24px;
    height: 24px;
    border: 2px solid var(--secondary);
    border-radius: 50%;
    margin-right: 15px;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}
.option-input:checked + .option-label .check-circle {
    border-color: var(--primary);
    background-color: var(--primary);
}
.check-circle::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 10px;
    height: 10px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.2s ease;
}
.option-input:checked + .option-label .check-circle::after {
    transform: translate(-50%, -50%) scale(1);
}

.option-text {
    color: var(--light-text);
    font-size: 1.05rem;
}
.option-input:checked + .option-label .option-text {
    color: white;
    font-weight: 500;
}

/* Gradient Button */
.btn-gradient-primary {
    background: linear-gradient(135deg, var(--dusk-blue) 0%, #2c3e50 100%);
    border: none;
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.btn-gradient-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    color: white;
}
.tracking-wider { letter-spacing: 1px; }

/* Timer Pulse */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
.timer-warning {
    animation: pulse 1s infinite;
    background-color: #ef4444 !important;
    color: white !important;
}
</style>

<?php if($quiz['time_limit'] > 0): ?>
<script>
    // Robust Timer
    let timeLimit = <?php echo $quiz['time_limit']; ?> * 60; // seconds
    const timerDisplay = document.getElementById('time-remaining');
    const timerBadge = document.querySelector('.timer-badge');
    
    // Prevent accidental navigation
    window.onbeforeunload = function() {
        return "Are you sure? Your quiz progress will be lost.";
    };
    
    // Handle form submit to remove warning
    document.getElementById('quizForm').onsubmit = function() {
        window.onbeforeunload = null;
    };
    
    const timerInterval = setInterval(() => {
        const minutes = Math.floor(timeLimit / 60);
        const seconds = timeLimit % 60;
        
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
        // Visual warning when low
        if (timeLimit < 60) {
            timerBadge.classList.add('timer-warning');
        }
        
        if (timeLimit <= 0) {
            clearInterval(timerInterval);
            window.onbeforeunload = null;
            document.getElementById('quizForm').submit();
        }
        timeLimit--;
    }, 1000);
</script>
<?php endif; ?>

<?php include_once '../includes/footer.php'; ?>
