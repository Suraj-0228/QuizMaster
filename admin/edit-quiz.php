<?php include_once 'components/edit-quiz-process.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Navigation -->
            <div class="mb-4">
                <a href="quizzes.php" class="btn btn-outline-light btn-sm rounded-pill px-3 opacity-75 hover-opacity-100">
                    <i class="fas fa-arrow-left me-2"></i>Back to Quizzes
                </a>
            </div>

            <div class="glass-card border-0 shadow-lg position-relative overflow-hidden">
                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <h5 class="mb-0 text-light fw-bold"><i class="fas fa-edit me-2 text-warning"></i> Edit Quiz</h5>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <form action="" method="POST">
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label text-light small text-uppercase fw-bold mb-2">Quiz Title</label>
                            <div class="input-group premium-input-group">
                                <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-secondary"><i class="fas fa-heading"></i></span>
                                <input type="text" class="form-control bg-transparent text-white border-secondary border-opacity-50" id="title" name="title" value="<?php echo sanitize($quiz['title']); ?>" required>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label text-light small text-uppercase fw-bold mb-2">Description</label>
                            <textarea class="form-control bg-transparent text-white border-secondary border-opacity-50" id="description" name="description" rows="3"><?php echo sanitize($quiz['description']); ?></textarea>
                        </div>
                        
                        <div class="row g-4 mb-4">
                            <!-- Category -->
                            <div class="col-md-12">
                                <label for="category_id" class="form-label text-light small text-uppercase fw-bold mb-2">Category</label>
                                <select class="form-select bg-transparent text-white border-secondary border-opacity-50" id="category_id" name="category_id" required>
                                    <option value="" disabled class="bg-dark">Choose a category...</option>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $quiz['category_id'] ? 'selected' : ''; ?> class="bg-dark">
                                            <?php echo sanitize($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Time Limit -->
                            <div class="col-md-6">
                                <label for="time_limit" class="form-label text-light small text-uppercase fw-bold mb-2">Time Limit (Minutes)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-secondary"><i class="fas fa-clock"></i></span>
                                    <input type="number" class="form-control bg-transparent text-white border-secondary border-opacity-50" id="time_limit" name="time_limit" value="<?php echo $quiz['time_limit']; ?>" min="0">
                                </div>
                            </div>
                            
                            <!-- Passing Score -->
                            <div class="col-md-6">
                                <label for="passing_score" class="form-label text-light small text-uppercase fw-bold mb-2">Passing Score (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-secondary"><i class="fas fa-percentage"></i></span>
                                    <input type="number" class="form-control bg-transparent text-white border-secondary border-opacity-50" id="passing_score" name="passing_score" value="<?php echo $quiz['passing_score']; ?>" min="1" max="100" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="d-grid pt-2">
                            <button type="submit" class="btn btn-gradient-primary btn-lg shadow-lg fw-bold">
                                <i class="fas fa-save me-2"></i>Update Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>
