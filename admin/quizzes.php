<?php include_once 'controllers/manage-quiz.php'; ?>

<div class="container py-4">
    <!-- Hero Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="display-5 fw-bold text-light mb-2">Manage Quizzes</h1>
            <p class="text-muted lead mb-0">Create, edit, and organize your quizzes.</p>
        </div>
        <a href="add-quiz.php" class="btn btn-gradient-primary rounded-pill px-4 hover-scale shadow-sm">
            <i class="fas fa-plus me-2"></i> Add Quiz
        </a>
    </div>

    <!-- Quizzes Table -->
    <div class="glass-card border-0 shadow-lg position-relative overflow-hidden mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); color: var(--light-text);">
                    <thead class="bg-dark bg-opacity-50 border-bottom border-secondary border-opacity-25">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted small border-0">Title</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Category</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Time</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-center">Questions</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (count($quizzes) > 0): ?>
                            <?php foreach($quizzes as $quiz): ?>
                                <tr class="border-bottom border-light border-opacity-10 transition-all">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-book text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-light"><?php echo sanitize($quiz['title']); ?></div>
                                                <small class="text-muted line-clamp-1" style="max-width: 250px;"><?php echo sanitize($quiz['description']); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3">
                                            <?php echo sanitize($quiz['category_name']); ?>
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <?php if($quiz['time_limit'] > 0): ?>
                                            <span class="text-warning"><i class="fas fa-clock me-1"></i> <?php echo $quiz['time_limit']; ?>m</span>
                                        <?php else: ?>
                                            <span class="text-success"><i class="fas fa-infinity me-1"></i> No Limit</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge bg-secondary bg-opacity-20 text-white rounded-pill px-3">
                                            <?php echo $quiz['question_count']; ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <div class="d-inline-flex gap-1">
                                            <a href="questions.php?quiz_id=<?php echo $quiz['id']; ?>" class="btn btn-icon btn-sm btn-outline-info rounded-circle border-0 bg-transparent opacity-75 hover-opacity-100" title="Manage Questions">
                                                <i class="fas fa-list-ul"></i>
                                            </a>
                                            <a href="edit-quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-icon btn-sm btn-outline-warning rounded-circle border-0 bg-transparent opacity-75 hover-opacity-100" title="Edit Quiz">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this quiz? This cannot be undone.');">
                                                <input type="hidden" name="quiz_id" value="<?php echo $quiz['id']; ?>">
                                                <button type="submit" name="delete_quiz" class="btn btn-icon btn-sm btn-outline-danger rounded-circle border-0 bg-transparent opacity-75 hover-opacity-100" title="Delete Quiz">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted opacity-50 mb-3"><i class="fas fa-box-open fa-3x"></i></div>
                                    <h5 class="text-light">No quizzes found</h5>
                                    <p class="text-muted small">Get started by creating your first quiz.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>

