<?php include_once 'controllers/contact-process.php'; ?>

<div class="row align-items-center py-5">
    <!-- Contact Info Column -->
    <div class="col-lg-5 mb-5 mb-lg-0">
        <h1 class="display-4 fw-bold text-light mb-3">Let's <span class="text-gradient">Connect</span></h1>
        <p class="text-muted lead mb-5">
            We're here to help and answer any question you might have. We look forward to hearing from you.
        </p>
        
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 flex-shrink-0">
                <i class="fas fa-envelope fa-2x text-primary"></i>
            </div>
            <div>
                <h5 class="text-light mb-1">Email Us</h5>
                <p class="text-muted mb-0">quizmastera524@gmail.com</p>
            </div>
        </div>
        
        <div class="d-flex align-items-center mb-4">    
            <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3 flex-shrink-0">
                <i class="fas fa-phone fa-2x text-success"></i>
            </div>
            <div>
                <h5 class="text-light mb-1">Call Us</h5>
                <p class="text-muted mb-0">+1 (555) 123-4567</p>
            </div>
        </div>
        
        <div class="d-flex align-items-center mb-5">
            <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3 flex-shrink-0">
                <i class="fas fa-map-marker-alt fa-2x text-info"></i>
            </div>
            <div>
                <h5 class="text-light mb-1">Visit Us</h5>
                <p class="text-muted mb-0">123 Education Lane, Tech City</p>
            </div>
        </div>

        <div class="d-flex gap-3">
            <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <!-- Contact Form Column -->
    <div class="col-lg-6 offset-lg-1">
        <?php if($message): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show mb-4 glass-alert" role="alert">
                <i class="fas <?php echo ($messageType == 'success') ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> me-2"></i>
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card glass-card border-0 shadow-lg position-relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 end-0 p-4 opacity-10">
                <i class="fas fa-paper-plane fa-6x text-light transform-rotate-45"></i>
            </div>
            
            <div class="card-body p-4 p-md-5 position-relative z-1">
                <h3 class="text-light fw-bold mb-2">Send a Message</h3>
                <p class="text-muted mb-5 small">We usually respond within 24 hours.</p>
                
                <form action="" method="POST">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="premium-input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="premium-control" id="name" name="name" placeholder=" ">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="premium-input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="premium-control" id="email" name="email" placeholder=" ">
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="premium-input-group">
                                <i class="fas fa-tag input-icon"></i>
                                <select class="premium-control" id="subject" name="subject">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Support">Technical Support</option>
                                    <option value="Feedback">Feedback</option>
                                    <option value="Partnership">Partnership</option>
                                </select>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="premium-input-group">
                                <i class="fas fa-comment-alt input-icon mt-2"></i>
                                <textarea class="premium-control" id="message" name="message" style="height: 120px" placeholder=" "></textarea>
                                <label for="message">Your Message</label>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-gradient-primary w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                                Send Message <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Premium Form Styles */
.premium-input-group {
    position: relative;
    margin-bottom: 1rem;
}

.input-icon {
    position: absolute;
    left: 0;
    top: 15px;
    color: var(--secondary);
    font-size: 1.1rem;
    transition: all 0.3s ease;
    z-index: 2;
}

.premium-control {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 0;
    padding: 10px 10px 10px 35px; /* Space for icon */
    color: #fff;
    font-size: 1rem;
    transition: all 0.3s ease;
    outline: none;
}

.premium-control:focus {
    border-bottom-color: var(--primary);
    background: linear-gradient(to bottom, transparent 95%, rgba(var(--primary-rgb), 0.1) 100%);
}

.premium-control:focus + label,
.premium-control:not(:placeholder-shown) + label {
    top: -20px;
    left: 0;
    font-size: 0.85rem;
    color: var(--primary);
}

.premium-input-group label {
    position: absolute;
    left: 35px;
    top: 10px;
    color: #6c757d;
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.3s ease;
}

/* Specific fix for select which handles placeholder differently */
select.premium-control {
    padding-left: 30px;
    cursor: pointer;
}
select.premium-control option {
    background-color: var(--dark-bg);
    color: white;
}

.premium-control:focus ~ .input-icon {
    color: var(--primary);
}

/* Button & Card tweaks */
.transform-rotate-45 { transform: rotate(-20deg); opacity: 0.1; }
.hover-scale:hover { transform: scale(1.02); }
.btn-gradient-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #4facfe 100%);
    border: none;
    color: white;
}
</style>

<?php include_once 'includes/footer.php'; ?>
