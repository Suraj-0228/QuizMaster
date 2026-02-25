<?php include_once 'controllers/reset-password-process.php'; ?>

<div class="row justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card glass-card border-0 shadow-lg overflow-hidden position-relative auth-card">
            
            <div class="position-absolute top-0 end-0 p-4 opacity-10">
                <i class="fas fa-unlock-alt fa-6x text-light transform-rotate-15"></i>
            </div>
            
            <div class="card-body p-4 p-md-5 position-relative z-1">
                <div class="text-center mb-4">
                    <div class="icon-circle bg-success bg-opacity-10 text-success mb-3 mx-auto">
                        <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <h3 class="text-light fw-bold">Set New Password</h3>
                    <p class="text-muted small">Please enter and confirm your new strong password below.</p>
                </div>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show glass-alert border-danger border-opacity-25" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle fs-4 me-3 text-danger"></i>
                            <div class="flex-grow-1">
                                <ul class="mb-0 ps-3 small text-start text-danger">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <form action="" method="POST" class="needs-validation" novalidate>
                    <!-- IMPORTANT: Hidden token input -->
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                    
                    <div class="premium-input-group mb-3">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="premium-control" id="password" name="password" placeholder=" " required minlength="6">
                        <label for="password">New Password</label>
                        <div class="invalid-feedback ps-2 mt-4 text-start">Password must be at least 6 characters.</div>
                    </div>
                    
                    <div class="premium-input-group mb-4">
                        <i class="fas fa-check-circle input-icon"></i>
                        <input type="password" class="premium-control" id="confirm_password" name="confirm_password" placeholder=" " required minlength="6">
                        <label for="confirm_password">Confirm New Password</label>
                        <div class="invalid-feedback ps-2 mt-4 text-start">Please confirm your password.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-success w-100 py-3 rounded-3 fw-bold mb-4 shadow-lg hover-scale transition-all">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Same premium styles */
.min-vh-75 { min-height: 75vh; }
.auth-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
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
    border-bottom-color: #28a745;
    background: linear-gradient(to bottom, transparent 95%, rgba(40, 167, 69, 0.1) 100%);
}
.premium-control:focus + label,
.premium-control:not(:placeholder-shown) + label {
    top: -20px;
    left: 0;
    font-size: 0.85rem;
    color: #28a745;
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
.premium-control:focus ~ .input-icon {
    color: #28a745;
}
.btn-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    color: white;
}
.hover-scale:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; color: white;}
.transform-rotate-15 { transform: rotate(15deg); }
</style>

<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

<?php include_once 'includes/footer.php'; ?>
