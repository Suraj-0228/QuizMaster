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
            <?php 
                $total_questions = count($questions);
                $time_per_question = $quiz['time_limit'] > 0 ? floor(($quiz['time_limit'] * 60) / $total_questions) : 0;
            ?>
            
            <?php foreach($questions as $index => $q): ?>
                <div class="card mb-5 border-0 shadow-lg glass-card position-relative overflow-hidden question-card" id="q_<?php echo $index; ?>" style="<?php echo $index > 0 ? 'display: none;' : ''; ?>">
                    <div class="position-absolute top-0 start-0 w-100 bg-gradient-primary" style="height: 4px;"></div>
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex">
                                <span class="display-4 text-muted opacity-25 me-3" style="line-height: 1;">
                                    <?php echo sprintf("%02d", $index + 1); ?>
                                </span>
                                <h4 class="card-title text-light mb-0 pt-2" style="line-height: 1.4;">
                                    <?php echo sanitize($q['question_text']); ?>
                                </h4>
                            </div>
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

                        <div class="d-flex flex-column flex-md-row gap-3 mt-5">
                            <button type="button" onclick="cancelQuiz()" class="btn btn-outline-danger py-3 rounded-pill fw-bold tracking-wider w-100">
                                Cancel Quiz <i class="fas fa-times ms-2"></i>
                            </button>
                            <?php if ($index == $total_questions - 1): ?>
                                <button type="button" class="btn btn-gradient-primary py-3 rounded-pill shadow-lg text-uppercase fw-bold tracking-wider next-btn w-100">
                                    Submit Quiz <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-gradient-primary py-3 rounded-pill shadow-lg text-uppercase fw-bold tracking-wider next-btn w-100">
                                    Next Question <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</div>

<script>
    let currentQuestionIndex = 0;
    const totalQuestions = <?php echo $total_questions ?? 0; ?>;
    const form = document.getElementById('quizForm');
    
    <?php if(isset($time_per_question) && $time_per_question > 0): ?>
    
    const timePerQuestion = <?php echo $time_per_question; ?>; // seconds
    let currentTimeLimit = timePerQuestion;
    let timerInterval;
    
    const timerDisplay = document.getElementById('time-remaining');
    const timerBadge = document.querySelector('.timer-badge');
    
    function startTimer() {
        currentTimeLimit = timePerQuestion;
        timerBadge.classList.remove('timer-warning');
        updateTimerDisplay();
        
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            currentTimeLimit--;
            updateTimerDisplay();
            
            if (currentTimeLimit < 10) {
                timerBadge.classList.add('timer-warning');
            }
            
            if (currentTimeLimit <= 0) {
                clearInterval(timerInterval);
                advanceQuestion(true);
            }
        }, 1000);
    }
    
    function updateTimerDisplay() {
        const minutes = Math.floor(currentTimeLimit / 60);
        const seconds = currentTimeLimit % 60;
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }
    
    <?php endif; ?>

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        return "Are you sure? Your quiz progress will be lost.";
    };
    
    function advanceQuestion(isAutoAdvance = false) {
        const currentCard = document.getElementById(`q_${currentQuestionIndex}`);
        
        if (!isAutoAdvance) {
            const checkedOption = currentCard.querySelector('input[type="radio"]:checked');
            if (!checkedOption) {
                let errorTxt = currentCard.querySelector('.error-text');
                if (!errorTxt) {
                    errorTxt = document.createElement('p');
                    errorTxt.className = 'error-text text-danger mt-4 mb-0 text-center fw-bold';
                    errorTxt.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Please, Select an Answer Before Proceeding!!';
                    currentCard.querySelector('.card-body').appendChild(errorTxt);
                    
                    setTimeout(() => errorTxt.remove(), 3500);
                }
                return;
            }
        }

        currentCard.style.display = 'none';
        
        currentQuestionIndex++;
        
        if (currentQuestionIndex < totalQuestions) {
            const nextCard = document.getElementById(`q_${currentQuestionIndex}`);
            nextCard.style.display = 'block';
            
            <?php if(isset($time_per_question) && $time_per_question > 0): ?>
            startTimer();
            <?php endif; ?>
        } else {
            submitQuiz();
        }
    }

    function submitQuiz() {
        window.onbeforeunload = null;
        <?php if(isset($time_per_question) && $time_per_question > 0): ?>
        clearInterval(timerInterval);
        <?php endif; ?>
        form.submit();
    }

    function cancelQuiz() {
        if(confirm("Are you sure you want to cancel the quiz? Your progress will be lost!!")) {
            window.onbeforeunload = null;
            window.location.href = 'quizzes.php';
        }
    }

    // Attach event listeners to next buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            advanceQuestion(false);
        });
    });

    // Start timer for the first question
    <?php if(isset($time_per_question) && $time_per_question > 0): ?>
    startTimer();
    <?php endif; ?>
</script>

<?php include_once '../includes/footer.php'; ?>
