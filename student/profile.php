<?php include_once '../controllers/profile-process.php'; ?>

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
                    <?php if (!empty($user['profile_pic'])): ?>
                        <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile Picture" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                    <?php else: ?>
                        <span class="fw-bold"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                    <?php endif; ?>
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
                
                <?php if (!empty($user['profile_pic'])): ?>
                <form action="" method="POST" class="mb-4" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                    <input type="hidden" name="remove_profile_pic_only" value="1">
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm transition-hover">
                        <i class="fas fa-trash-alt me-1"></i> Remove Picture
                    </button>
                </form>
                <?php endif; ?>
                
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
                                <span class="text-light fw-bold">India</span>
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
                                <button class="btn btn-outline-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                            </div>
                            <p class="text-muted mb-0">
                                <?php if (!empty($user['bio'])): ?>
                                    <?php echo nl2br(sanitize($user['bio'])); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="row g-4">
                        <!-- Password Change -->
                        <div class="col-md-12">
                            <div class="card glass-card border-0 shadow overflow-hidden">
                                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-4 px-4 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="text-light fw-bold mb-1">Security Settings</h5>
                                        <p class="text-muted small mb-0">Manage your password and account security</p>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                        <i class="fas fa-shield-alt text-primary fa-lg"></i>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <form action="" method="POST">
                                        <input type="hidden" name="update_password" value="1">
                                        
                                        <div class="row g-4 align-items-end">
                                            <div class="col-md-5">
                                                <div class="premium-input-group mb-0">
                                                     <i class="fas fa-lock input-icon"></i>
                                                    <input type="password" class="premium-control" name="password" placeholder=" ">
                                                    <i class="fas fa-eye password-toggle"></i>
                                                    <label>New Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="premium-input-group mb-0">
                                                    <i class="fas fa-check-circle input-icon"></i>
                                                    <input type="password" class="premium-control" name="confirm_password" placeholder=" ">
                                                    <i class="fas fa-eye password-toggle"></i>
                                                    <label>Confirm Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 shadow-sm">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3 d-flex align-items-center text-muted small">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>Make sure your password is strong and secure.</span>
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
</div>

<!-- Edit Profile Modal (Premium Redesign) -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal border-0 overflow-hidden">
            <div class="modal-header border-0 px-5 pt-5 pb-0">
                <div>
                    <h4 class="modal-title fw-bold text-light mb-1">Edit Profile</h4>
                    <p class="text-muted small mb-0">Update your personal information</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="update_profile" value="1">
                    
                    <div class="text-center mb-4">
                        <label for="profileUpload" class="cursor-pointer position-relative d-inline-block">
                            <div class="profile-avatar-floating mx-auto mb-2" style="width: 80px; height: 80px; font-size: 32px;">
                                <?php if (!empty($user['profile_pic'])): ?>
                                    <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                                <?php else: ?>
                                    <span class="fw-bold"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="position-absolute bg-primary rounded-circle d-flex align-items-center justify-content-center shadow" 
                                 style="width: 32px; height: 32px; bottom: 10px; right: -5px; border: 3px solid #1b263b; cursor: pointer; transition: transform 0.2s ease;">
                                <i class="fas fa-camera text-white" style="font-size: 14px;"></i>
                            </div>
                        </label>
                        <input type="file" id="profileUpload" name="profile_pic" class="d-none" accept="image/jpeg,image/png,image/gif">
                        <p class="text-muted small mb-0 mt-2">Click to update picture (JPG, PNG, GIF Max 2MB)</p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold mb-2">USERNAME</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark-glass  text-secondary"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control premium-control ps-2" name="username" value="<?php echo sanitize($user['username']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold mb-2">EMAIL ADDRESS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark-glass  text-secondary"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control premium-control ps-2" name="email" value="<?php echo sanitize($user['email']); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label text-light small fw-bold mb-2">BIO / ABOUT ME</label>
                        <div class="input-group">
                             <span class="input-group-text bg-dark-glass  text-secondary align-items-start pt-3"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control premium-control ps-2" name="bio" rows="4" placeholder="Tell us about yourself..."><?php echo sanitize($user['bio'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-text text-muted text-end">Share a brief description of who you are.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-lg">Save Changes</button>
                    </div>
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
    color: #ffffff;
    font-size: 32px;
    box-shadow:
        0 0 20px rgba(47, 124, 255, 0.6),
        inset 0 0 10px rgba(255, 255, 255, 0.15);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Fix icon positioning in premium-input-group */
.premium-input-group .input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    z-index: 5;
    pointer-events: none; /* Just in case */
}

/* Premium Modal Styles */
.glass-modal {
    background: rgba(27, 38, 59, 0.95); /* Matches --card-bg with opacity */
    backdrop-filter: blur(20px);
    border: 1px solid rgba(119, 141, 169, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.premium-control {
    background-color: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(119, 141, 169, 0.2);
    /* border-left: 0; Removed global removal */
    color: var(--light-text) !important;
    transition: all 0.3s ease;
}

/* Modal Input Groups: Remove left border to merge with icon */
.input-group .premium-control {
    border-left: 0;
}

.premium-control:focus {
    background-color: rgba(255, 255, 255, 0.08) !important;
    border-color: var(--dusk-blue);
    box-shadow: none;
}

.input-group-text {
    border: 1px solid rgba(119, 141, 169, 0.2);
    border-right: 0;
    color: var(--secondary);
}

.form-control::placeholder {
    color: rgba(224, 225, 221, 0.3); /* Based on --alabaster-grey */
}

</style>

<?php include_once '../includes/footer.php'; ?>
