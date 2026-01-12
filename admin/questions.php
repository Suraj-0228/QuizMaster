<?php include_once 'controllers/que-process.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="quizzes.php" class="text-secondary text-decoration-none">Quizzes</a></li>
                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">Manage Questions</li>
                </ol>
            </nav>
            <h2 class="text-light fw-bold"><?php echo sanitize($quiz['title']); ?></h2>
            <p class="text-muted small mb-0">Manage and organize the questions for this quiz.</p>
        </div>
        <a href="add-question.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-gradient-primary rounded-pill px-4 hover-scale shadow-sm">
            <i class="fas fa-plus me-2"></i> Add Question
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if (count($questions) > 0): ?>
                <div class="vstack gap-4">
                    <?php foreach($questions as $index => $q): ?>
                        <div class="glass-card border-0 p-4 position-relative overflow-hidden group-hover-effect">
                            <!-- Question Header -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-20 text-white fw-bold" style="width: 40px; height: 40px;">
                                            Q<?php echo $index + 1; ?>
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="text-light mb-1"><?php echo sanitize($q['question_text']); ?></h5>
                                        <span class="badge bg-secondary bg-opacity-20 text-white rounded-pill px-3 py-1 mt-1">
                                            Marks: <?php echo $q['marks']; ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <form method="POST" class="d-inline ms-2" onsubmit="return confirm('Delete this question?');">
                                    <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
                                    <button type="submit" name="delete_question" class="btn btn-icon btn-outline-danger rounded-circle border-0 bg-transparent opacity-50 hover-opacity-100" title="Delete Question">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Options Grid -->
                            <div class="ps-5 ms-2 rounded-3 bg-dark bg-opacity-25 p-3">
                                <?php 
                                    $opt_stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ?");
                                    $opt_stmt->execute([$q['id']]);
                                    $options = $opt_stmt->fetchAll();
                                ?>
                                <div class="row g-2">
                                    <?php foreach($options as $opt): ?>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-2 rounded <?php echo $opt['is_correct'] ? 'bg-success bg-opacity-10 border border-success border-opacity-25' : 'bg-transparent'; ?>">
                                                <?php if($opt['is_correct']): ?>
                                                    <i class="fas fa-check-circle text-success me-3"></i>
                                                <?php else: ?>
                                                    <i class="far fa-circle text-muted me-3 opacity-50"></i>
                                                <?php endif; ?>
                                                <span class="<?php echo $opt['is_correct'] ? 'text-success fw-medium' : 'text-muted'; ?>">
                                                    <?php echo sanitize($opt['option_text']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="glass-card text-center py-5">
                    <div class="mb-4 text-muted opacity-50">
                        <i class="fas fa-clipboard-question fa-4x"></i>
                    </div>
                    <h4 class="text-light">No Questions Yet</h4>
                    <p class="text-muted mb-4">This quiz is empty. Start adding questions to build it.</p>
                    <a href="add-question.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-outline-light rounded-pill px-4">
                        <i class="fas fa-plus me-2"></i> Add First Question
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>

