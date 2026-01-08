<?php include_once 'components/settings-process.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-transparent border border-secondary border-opacity-50 rounded-circle text-info mb-3 shadow-lg" style="width: 70px; height: 70px;">
                    <i class="fas fa-cog fa-2x"></i>
                </div>
                <h2 class="fw-bold text-light mb-1">General Settings</h2>
                <p class="text-muted">Configure your application preferences.</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <?php if($messageType == 'success'): ?>
                            <i class="fas fa-check-circle me-2 fs-5"></i>
                        <?php else: ?>
                            <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                        <?php endif; ?>
                        <div><?php echo $message; ?></div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="glass-card border-0 shadow-lg position-relative overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="" method="POST">
                        <h5 class="text-light mb-4 pb-2 border-bottom border-secondary border-opacity-25">Site Configuration</h5>
                        
                        <!-- Site Name -->
                        <div class="mb-4">
                            <label for="site_name" class="form-label text-light small text-uppercase fw-bold mb-2">Application Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-success"><i class="fas fa-globe"></i></span>
                                <input type="text" class="form-control bg-transparent text-white border-secondary border-opacity-50" id="site_name" name="site_name" value="<?php echo isset($settings['site_name']) ? sanitize($settings['site_name']) : 'QuizMaster'; ?>" placeholder="e.g. QuizMaster" required>
                            </div>
                            <div class="form-text text-muted small mt-2"><i class="fas fa-info-circle me-1"></i>Displayed in the browser tab and main header.</div>
                        </div>
                        
                        <!-- Maintenance Mode -->
                        <div class="p-3 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 mb-4 transition-hover">
                            <div class="form-check form-switch d-flex align-items-center justify-content-between ps-0">
                                <label class="form-check-label text-light mb-0 cursor-pointer" for="maintenance_mode">
                                    <div class="fw-bold">Maintenance Mode</div>
                                    <div class="small text-muted">Restrict access to administrators only</div>
                                </label>
                                <input class="form-check-input ms-3 fs-5 cursor-pointer shadow-none" type="checkbox" id="maintenance_mode" name="maintenance_mode" <?php echo (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'checked' : ''; ?> style="cursor: pointer;">
                            </div>
                        </div>

                        <div class="d-grid pt-2">
                            <button type="submit" class="btn btn-gradient-primary btn-lg shadow-lg fw-bold">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="dashboard.php" class="text-muted text-decoration-none small hover-text-light transition-all">
                    <i class="fas fa-arrow-left me-1"></i> Return to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>
