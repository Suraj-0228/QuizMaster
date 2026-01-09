<?php include_once '../components/profile-process.php'; ?>

<!-- Profile Cover -->
<div class="profile-cover shadow-lg mb-4">
    <!-- Optional: Add a real background image here via inline style if user uploads one later -->
</div>

<div class="container px-lg-5">
    <div class="row">
        <!-- Sidebar / Info -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="glass-card p-4 text-center border-0 shadow-lg position-relative overflow-hidden h-100">
                <!-- Decorative Blur -->
                <div class="position-absolute top-0 start-50 translate-middle bg-primary opacity-10 rounded-circle" style="width: 200px; height: 200px; filter: blur(60px);"></div>
                
                <div class="profile-avatar-floating mx-auto mb-4 position-relative" style="margin-top: 0;">
                    <span class="fw-bold"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                    <div class="position-absolute bottom-0 end-0 p-2 bg-success border border-dark rounded-circle me-1 mb-1 shadow"></div>
                </div>
                
                <h3 class="text-light fw-bold mb-1"><?php echo sanitize($user['username']); ?></h3>
                <p class="text-muted mb-4 small"><i class="fas fa-envelope me-2"></i><?php echo sanitize($user['email']); ?></p>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2">
                        <?php echo ucfirst($user['role']); ?>
                    </span>
                    <span class="badge bg-dark-glass text-light border border-secondary border-opacity-25 rounded-pill px-3 py-2">
                        <i class="fas fa-check-circle text-success me-1"></i> Active
                    </span>
                </div>
                
                <hr class="border-secondary opacity-25 my-4">
                
                <div class="row g-3 text-start">
                    <div class="col-12">
                        <div class="p-3 rounded bg-dark-glass border border-secondary border-opacity-10 d-flex align-items-center transition-hover">
                            <div class="bg-secondary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="far fa-calendar-alt text-light"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">Joined Date</small>
                                <span class="text-light fw-bold"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-12">
                        <div class="p-3 rounded bg-dark-glass border border-secondary border-opacity-10 d-flex align-items-center transition-hover">
                            <div class="bg-secondary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="fas fa-globe-americas text-light"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem;">Region</small>
                                <span class="text-light fw-bold">Global</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills nav-pills-custom mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-2" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-2" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">Security & Settings</button>
                </li>
            </ul>
            
            <div class="tab-content" id="profileTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card glass-card border-0 shadow h-100 hover-lift">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <div class="bg-primary-subtle p-3 rounded-circle me-3">
                                        <i class="fas fa-trophy fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-light fw-bold mb-0"><?php echo $stats_count; ?></h3>
                                        <span class="text-muted">Quizzes Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card glass-card border-0 shadow h-100 hover-lift">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <div class="bg-success-subtle p-3 rounded-circle me-3">
                                        <i class="fas fa-chart-pie fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-light fw-bold mb-0"><?php echo $avg_score; ?>%</h3>
                                        <span class="text-muted">Average Score</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card glass-card border-0 shadow">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="text-light mb-0">About Me</h5>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill">Edit Bio</button>
                            </div>
                            <p class="text-muted mb-0">
                                Hello, I'm <strong class="text-light"><?php echo sanitize($user['username']); ?></strong>. I'm a passionate learner using QuizMaster to improve my skills.
                                Challenge me to a quiz!
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="row g-4">
                        <!-- Password Change -->
                        <div class="col-md-12">
                            <div class="card glass-card border-0 shadow">
                                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3">
                                    <h5 class="text-light mb-0">Change Password</h5>
                                </div>
                                <div class="card-body p-4">
                                    <form action="" method="POST">
                                        <input type="hidden" name="update_password" value="1">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="premium-input-group">
                                                     <i class="fas fa-lock input-icon"></i>
                                                    <input type="password" class="premium-control" name="password" placeholder=" ">
                                                    <i class="fas fa-eye password-toggle"></i>
                                                    <label>New Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="premium-input-group">
                                                    <i class="fas fa-check-circle input-icon"></i>
                                                    <input type="password" class="premium-control" name="confirm_password" placeholder=" ">
                                                    <i class="fas fa-eye password-toggle"></i>
                                                    <label>Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Danger Zone -->
                        <div class="col-md-12">
                             <div class="card border border-danger border-opacity-25 bg-danger-subtle h-100 shadow-sm">
                                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div>
                                        <h5 class="text-danger mb-1">Delete Account</h5>
                                        <p class="text-muted small mb-0">
                                            Permanently remove your account and content.
                                        </p>
                                    </div>
                                    <button class="btn btn-outline-danger rounded-pill px-4" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        Delete My Account
                                    </button>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal (Same as before) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border border-secondary shadow-lg">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-light">Delete Account?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="text-muted mb-4">This action cannot be undone. To confirm, type <strong>DELETE</strong> below.</p>
                <form action="" method="POST">
                    <input type="hidden" name="delete_account" value="1">
                    <div class="mb-4 w-75 mx-auto">
                        <input type="text" class="form-control bg-dark text-light border-danger text-center tracking-wider" name="confirm_delete" placeholder="DELETE" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-danger w-75 rounded-pill shadow">Permanently Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.bg-primary-subtle { background-color: rgba(65, 90, 119, 0.2); }
.bg-success-subtle { background-color: rgba(16, 185, 129, 0.2); }
.bg-danger-subtle { background-color: rgba(220, 53, 69, 0.05); }
.bg-dark-glass { background-color: rgba(0,0,0,0.3); }
.glass-card {
    background: rgba(27, 38, 59, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}

.profile-avatar-floating {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: radial-gradient(
        circle at top left,
        #2f7cff,
        #0a2a66,
        #081a3a
    );
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 32px;
    box-shadow:
        0 0 20px rgba(47, 124, 255, 0.6),
        inset 0 0 10px rgba(255, 255, 255, 0.15);
}

</style>

<?php include_once '../includes/footer.php'; ?>
