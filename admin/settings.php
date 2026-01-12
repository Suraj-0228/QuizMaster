<?php include_once 'controllers/settings-process.php'; ?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-5 align-items-end">
        <div class="col-md-8">
            <h2 class="fw-bold text-light mb-2">Settings & Configuration</h2>
            <p class="text-muted mb-0">Manage global application settings and preferences.</p>
        </div>
        <div class="col-md-4 text-md-end">
             <div class="d-inline-flex bg-dark-glass rounded-pill p-1 border border-secondary border-opacity-25">
                 <span class="px-3 py-1 text-light small"><i class="fas fa-server text-success me-2"></i>System Online</span>
             </div>
        </div>
    </div>

    <?php if($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show border-0 shadow-lg mb-5" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-<?php echo $messageType == 'success' ? 'check-circle' : 'exclamation-circle'; ?> fs-4 me-3"></i>
                <div><?php echo $message; ?></div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3">
            <div class="card glass-card border-0 shadow-lg sticky-top" style="top: 100px; z-index: 10;">
                <div class="nav flex-column nav-pills p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active d-flex align-items-center p-3 mb-2 rounded-3" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab">
                        <div class="icon-square bg-primary bg-opacity-10 text-primary me-3 rounded">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <span class="fw-semibold">General</span>
                    </button>
                    <button class="nav-link d-flex align-items-center p-3 mb-2 rounded-3" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab">
                        <div class="icon-square bg-danger bg-opacity-10 text-danger me-3 rounded">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span class="fw-semibold">System & Security</span>
                    </button>
                    <!-- Add more tabs here if needed -->
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="col-lg-9">
            <form action="" method="POST">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel">
                        <div class="card glass-card border-0 shadow-lg mb-4">
                            <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
                                <h5 class="text-light mb-0">Site Identity</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">APPLICATION NAME</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-glass text-secondary border-secondary border-opacity-25"><i class="fas fa-globe"></i></span>
                                            <input type="text" class="form-control premium-control" name="site_name" value="<?php echo isset($settings['site_name']) ? sanitize($settings['site_name']) : 'QuizMaster'; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">CONTACT EMAIL</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-glass text-secondary border-secondary border-opacity-25"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control premium-control" name="contact_email" value="<?php echo isset($settings['contact_email']) ? sanitize($settings['contact_email']) : ''; ?>" placeholder="support@example.com">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">SITE DESCRIPTION</label>
                                        <textarea class="form-control premium-control" name="site_description" rows="3" placeholder="Brief description of your platform..."><?php echo isset($settings['site_description']) ? sanitize($settings['site_description']) : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="card glass-card border-0 shadow-lg mb-4">
                            <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
                                <h5 class="text-light mb-0">Display Options</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="text-light mb-1">Pagination Limit</h6>
                                        <p class="text-muted small mb-0">Number of items to display per page in lists.</p>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select premium-control" name="items_per_page">
                                            <option value="10" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '10') ? 'selected' : ''; ?>>10 Items</option>
                                            <option value="20" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '20') ? 'selected' : ''; ?>>20 Items</option>
                                            <option value="50" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '50') ? 'selected' : ''; ?>>50 Items</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Settings -->
                    <div class="tab-pane fade" id="v-pills-system" role="tabpanel">
                         <div class="card glass-card border-0 shadow-lg mb-4">
                            <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
                                <h5 class="text-light mb-0">Access Control</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Maintenance Mode -->
                                <div class="d-flex align-items-center justify-content-between p-3 rounded bg-dark bg-opacity-25 border border-secondary border-opacity-10 mb-3 hover-lift transition-all">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded me-3 text-warning">
                                            <i class="fas fa-tools fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-light fw-bold mb-1">Maintenance Mode</h6>
                                            <p class="text-muted small mb-0">Restrict access to administrators only.</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input fs-4 cursor-pointer" type="checkbox" name="maintenance_mode" <?php echo (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'checked' : ''; ?>>
                                    </div>
                                </div>

                                <!-- Registration -->
                                <div class="d-flex align-items-center justify-content-between p-3 rounded bg-dark bg-opacity-25 border border-secondary border-opacity-10 hover-lift transition-all">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 p-3 rounded me-3 text-success">
                                            <i class="fas fa-user-plus fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-light fw-bold mb-1">Allow Registration</h6>
                                            <p class="text-muted small mb-0">Enable new user sign-ups.</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input fs-4 cursor-pointer" type="checkbox" name="allow_registration" <?php echo (isset($settings['allow_registration']) && $settings['allow_registration'] == '1') ? 'checked' : ''; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sticky Footer Actions -->
                <div class="fixed-bottom p-3 bg-dark-glass border-top border-secondary border-opacity-25 d-flex justify-content-end gap-3" style="left: 280px; backdrop-filter: blur(20px);">
                     <button type="button" class="btn btn-outline-light rounded-pill px-4" onclick="window.history.back()">Cancel</button>
                     <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-lg fw-bold"><i class="fas fa-save me-2"></i>Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.nav-pills .nav-link {
    color: var(--light-text);
    transition: all 0.3s ease;
}
.nav-pills .nav-link:hover {
    background: rgba(255, 255, 255, 0.05);
}
.nav-pills .nav-link.active {
    background: linear-gradient(135deg, rgba(65, 90, 119, 0.5), rgba(27, 38, 59, 0.5));
    border: 1px solid rgba(119, 141, 169, 0.3);
    color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.icon-square {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<?php include_once '../includes/admin-footer.php'; ?>
