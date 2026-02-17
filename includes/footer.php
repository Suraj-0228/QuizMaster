</div> <!-- End Container -->

<?php if (isLoggedIn() && isAdmin()): ?>
    </div> <!-- End Admin Main Content -->
<?php endif; ?>

    <footer class="footer mt-auto py-5 relative-footer">
        <div class="container">
            <div class="row g-5">
                <!-- Brand Column -->
                <div class="col-lg-4 col-md-6">
                    <a href="<?php echo base_url(); ?>" class="text-decoration-none d-flex align-items-center mb-3 footer-brand">
                        <i class="fas fa-graduation-cap fa-2x me-2"></i>
                        <span class="h4 fw-bold text-light mb-0">QuizMaster</span>
                    </a>
                    <p class="mb-4">
                        Empowering students and professionals to master new skills through interactive assessments and data-driven insights.
                    </p>
                    <div class="d-flex">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Explore Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-heading">Explore</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>" class="footer-link">Home</a></li>
                        <li><a href="<?php echo base_url('student/quizzes.php'); ?>" class="footer-link">Quizzes</a></li>
                        <li><a href="<?php echo base_url('about.php'); ?>" class="footer-link">About Us</a></li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-heading">Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('faq.php'); ?>" class="footer-link">Help Center</a></li>
                        <li><a href="<?php echo base_url('contact.php'); ?>" class="footer-link">Contact Us</a></li>
                        <li><a href="<?php echo base_url('privacy.php'); ?>" class="footer-link">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url('terms.php'); ?>" class="footer-link">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-heading">Stay Updated</h5>
                    <p class="small text-muted mb-3">Subscribe to our newsletter for new quizzes and learning tips.</p>
                    <form action="#" class="mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control newsletter-input" placeholder="Your email address">
                            <button class="btn btn-primary" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <p class="small text-muted">
                        <i class="fas fa-lock me-1"></i> Secure subscription
                    </p>
                </div>
            </div>

            <hr class="mt-5 mb-4 border-secondary opacity-25">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 small text-muted">&copy; <?php echo date('Y'); ?> QuizMaster. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end d-none d-md-block">
                    <p class="mb-0 small text-muted">Built with <i class="fas fa-lightbulb text-warning mx-1"></i> for learning and growth</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/validation.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>
