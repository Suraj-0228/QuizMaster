<?php include_once 'controllers/students-process.php'; ?>

<div class="container py-4">
    <!-- Hero Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="display-5 fw-bold text-light mb-2">Registered Students</h1>
            <p class="text-muted lead mb-0">Monitor student progress and activity.</p>
        </div>
        <div class="glass-badge px-4 py-2 rounded-pill">
            <i class="fas fa-users text-primary me-2"></i>
            <span class="fw-bold text-light"><?php echo count($students); ?></span> <span class="text-muted">Total Students</span>
        </div>
    </div>

    <!-- Students Table -->
    <div class="glass-card border-0 shadow-lg position-relative overflow-hidden mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: rgba(255,255,255,0.05); color: var(--light-text);">
                    <thead class="bg-dark bg-opacity-50 border-bottom border-secondary border-opacity-25">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted small border-0">Student</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Email</th>
                            <th class="py-3 text-uppercase text-muted small border-0">Joined</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-center">Quizzes Taken</th>
                            <th class="py-3 text-uppercase text-muted small border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php if (count($students) > 0): ?>
                            <?php foreach($students as $student): ?>
                                <tr class="border-bottom border-light border-opacity-10 transition-all">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px;">
                                                <span class="fw-bold text-white"><?php echo strtoupper(substr($student['username'], 0, 1)); ?></span>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-light"><?php echo sanitize($student['username']); ?></div>
                                                <small class="text-muted">ID: #<?php echo $student['id']; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted">
                                        <?php echo sanitize($student['email']); ?>
                                    </td>
                                    <td class="py-3 text-muted">
                                        <i class="far fa-calendar-alt me-1 opacity-50"></i>
                                        <?php echo date('M d, Y', strtotime($student['created_at'])); ?>
                                    </td>
                                    <td class="py-3 text-center">
                                        <?php if($student['quizzes_taken'] > 0): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                                <?php echo $student['quizzes_taken']; ?> Quizzes
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary bg-opacity-20 text-secondary rounded-pill px-3">
                                                Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="student-details.php?id=<?php echo $student['id']; ?>" class="btn btn-icon btn-sm btn-outline-info rounded-circle" title="View History">
                                                <i class="fas fa-chart-line"></i>
                                            </a>
                                            
                                            <!-- Block Toggle -->
                                            <form action="" method="POST" class="d-inline">
                                                <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
                                                <input type="hidden" name="action" value="toggle_block">
                                                <button type="submit" class="btn btn-icon btn-sm <?php echo $student['is_blocked'] ? 'btn-danger' : 'btn-outline-warning'; ?> rounded-circle" 
                                                        title="<?php echo $student['is_blocked'] ? 'Unblock Student' : 'Block Student'; ?>">
                                                    <i class="fas <?php echo $student['is_blocked'] ? 'fa-ban' : 'fa-user-lock'; ?>"></i>
                                                </button>
                                            </form>
                                            
                                            <!-- Delete -->
                                            <form action="" method="POST" class="d-inline" onsubmit="return confirm('Are you sure? This will delete the student and all their quiz attempts.');">
                                                <input type="hidden" name="user_id" value="<?php echo $student['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-icon btn-sm btn-outline-danger rounded-circle" title="Delete Student">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted opacity-50 mb-3"><i class="fas fa-users-slash fa-3x"></i></div>
                                    <h5 class="text-light">No students found</h5>
                                    <p class="text-muted small">Share your quiz link to get students started.</p>
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
