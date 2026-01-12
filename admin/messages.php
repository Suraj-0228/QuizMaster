<?php require_once 'controllers/message-proccess.php'; ?>

<div class="container-fluid py-4">
    <!-- Stats & Header -->
    <div class="row g-4 mb-4">
        <div class="col-md-8">
             <h2 class="fw-bold text-light mb-1">Inbox</h2>
             <p class="text-muted small">Manage inquiries and support requests.</p>
        </div>
        <div class="col-md-4">
            <div class="d-flex gap-3 justify-content-md-end">
                <div class="glass-card p-3 rounded-4 d-flex align-items-center flex-grow-1 flex-md-grow-0 min-w-150">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                        <i class="fas fa-inbox fa-lg"></i>
                    </div>
                    <div>
                        <div class="h5 fw-bold text-light mb-0"><?php echo $total_messages; ?></div>
                        <div class="small text-muted">Total Messages</div>
                    </div>
                </div>
                <div class="glass-card p-3 rounded-4 d-flex align-items-center flex-grow-1 flex-md-grow-0 min-w-150">
                     <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3 text-success">
                        <i class="fas fa-calendar-day fa-lg"></i>
                    </div>
                    <div>
                        <div class="h5 fw-bold text-light mb-0"><?php echo $today_count; ?></div>
                        <div class="small text-muted">Today</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show glass-alert border-0 shadow-sm" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content Card -->
    <div class="card glass-card border-0 shadow-lg overflow-hidden" style="min-height: 600px;">
        <!-- Toolbar -->
        <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <form action="" method="GET" class="position-relative">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" name="search" class="form-control premium-control ps-5 rounded-pill" placeholder="Search messages..." value="<?php echo htmlspecialchars($search); ?>">
                    </form>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-outline-light btn-sm rounded-pill px-3" onclick="window.location.reload()">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                    <?php if(!empty($search)): ?>
                         <a href="messages.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3 ms-2">Clear Search</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <?php if (count($messages) > 0): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($messages as $msg): ?>
                        <?php 
                            // Generate Avatar Initials/Color
                            $initial = strtoupper(substr($msg['name'], 0, 1));
                            $colors = ['primary', 'success', 'danger', 'warning', 'info', 'secondary'];
                            $color_index = ord($initial) % count($colors);
                            $color = $colors[$color_index];
                        ?>
                        <div class="list-group-item bg-transparent border-secondary border-opacity-10 py-3 px-4 hover-bg-dark transition-all">
                            <div class="row align-items-center g-3">
                                <!-- Avatar & Sender -->
                                <div class="col-lg-3 d-flex align-items-center">
                                    <div class="avatar-circle bg-<?php echo $color; ?> bg-opacity-25 text-<?php echo $color; ?> me-3 flex-shrink-0 fw-bold">
                                        <?php echo $initial; ?>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="text-light mb-0 text-truncate"><?php echo sanitize($msg['name']); ?></h6>
                                        <small class="text-muted text-truncate d-block"><?php echo sanitize($msg['email']); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Preview -->
                                <div class="col-lg-6 cursor-pointer" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $msg['id']; ?>">
                                    <div class="d-flex flex-column">
                                        <span class="text-light fw-medium mb-1 text-truncate"><?php echo sanitize($msg['subject']); ?></span>
                                        <span class="text-muted small text-truncate" style="max-width: 90%;">
                                            <?php echo substr(sanitize($msg['message']), 0, 80) . '...'; ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Date & Actions -->
                                <div class="col-lg-3 text-lg-end">
                                    <div class="text-muted small mb-2"><?php echo date('M d, h:i A', strtotime($msg['created_at'])); ?></div>
                                    <div class="action-buttons opacity-0 transition-all">
                                        <button class="btn btn-icon btn-sm btn-outline-light rounded-circle" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $msg['id']; ?>" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
                                            <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                                            <input type="hidden" name="delete_message" value="1">
                                            <button type="submit" class="btn btn-icon btn-sm btn-outline-danger rounded-circle" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- View Modal (Optimized) -->
                         <div class="modal fade" id="viewModal<?php echo $msg['id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content glass-modal border-0">
                                    <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-<?php echo $color; ?> bg-opacity-25 text-<?php echo $color; ?> me-3 fw-bold">
                                                <?php echo $initial; ?>
                                            </div>
                                            <div>
                                                <h5 class="text-light mb-0"><?php echo sanitize($msg['name']); ?></h5>
                                                <small class="text-muted"><?php echo sanitize($msg['email']); ?></small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 p-lg-5">
                                        <div class="d-flex justify-content-between align-items-start mb-4">
                                            <h4 class="text-light fw-bold"><?php echo sanitize($msg['subject']); ?></h4>
                                            <div class="text-muted small bg-dark-glass px-3 py-1 rounded-pill border border-secondary border-opacity-25">
                                                <?php echo date('F j, Y at h:i A', strtotime($msg['created_at'])); ?>
                                            </div>
                                        </div>
                                        <div class="message-content text-light opacity-90 lh-lg p-3 rounded bg-dark bg-opacity-25">
                                            <?php echo nl2br(sanitize($msg['message'])); ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-3">
                                         <a href="mailto:<?php echo sanitize($msg['email']); ?>?subject=Re: <?php echo urlencode($msg['subject']); ?>" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-reply me-2"></i>Reply via Email
                                        </a>
                                        <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                 <div class="text-center py-5 my-5">
                    <div class="bg-dark-glass d-inline-block p-4 rounded-circle mb-3">
                        <i class="fas fa-inbox fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-light">No messages found</h5>
                    <p class="text-muted small">Try adjusting your search filters.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="card-footer bg-transparent border-top border-secondary border-opacity-25 py-3">
                <nav>
                    <ul class="pagination justify-content-center mb-0">
                         <!-- Simple Numbered Logic -->
                         <?php for($i=1; $i<=$total_pages; $i++): ?>
                            <li class="page-item <?php echo $page==$i ? 'active' : ''; ?>">
                                <a class="page-link <?php echo $page==$i ? 'bg-primary border-primary text-white text-shadow-none' : 'bg-transparent text-light border-secondary border-opacity-25'; ?> mx-1 rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                         <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255,255,255,0.1);
}
.hover-bg-dark:hover {
    background-color: rgba(0,0,0,0.2) !important;
}
.list-group-item:hover .action-buttons {
    opacity: 1;
}
.min-w-150 { min-width: 150px; }
.message-content {
    font-size: 1.05rem;
}
/* Pagination Override */
.page-link:focus { box-shadow: none; bg-color: transparent }
</style>

<?php include_once '../includes/admin-footer.php'; ?>
