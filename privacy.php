<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pageTitle = 'Privacy Policy';
include_once 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-light mb-2">Privacy Policy</h1>
                <p class="lead text-muted">How we handle and protect your data.</p>
            </div>

            <!-- Content Card -->
            <div class="glass-card border-0 shadow-lg position-relative overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5 text-light">
                    <p class="text-muted mb-5">Last updated: <?php echo date('F d, Y'); ?></p>

                    <h3 class="fw-bold text-primary mb-3">1. Information We Collect</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We collect information you provide directly to us when you create an account, participate in quizzes, or communicate with us. This may include your name, email address, password, and profile information. We also automatically collect certain information when you access our platform, such as your IP address, browser type, and usage data.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">2. How We Use Your Information</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We use the information we collect to operate, maintain, and improve our services. Specifically, we use your data to:
                        <ul class="text-muted mt-2">
                            <li>Provide and personalize your quiz experience.</li>
                            <li>Track your progress and generate performance reports.</li>
                            <li>Send administrative notifications and updates.</li>
                            <li>Detect and prevent fraudulent or unauthorized activity.</li>
                        </ul>
                    </p>

                    <h3 class="fw-bold text-primary mb-3">3. Data Security</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We implement appropriate technical and organizational measures to protect specific data. However, please be aware that no method of transmission over the internet is completely secure. We strive to use commercially acceptable means to protect your personal information, but we cannot guarantee its absolute security.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">4. Cookies</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We use cookies and similar tracking technologies to track the activity on our service and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">5. Third-Party Services</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We may employ third-party companies and individuals to facilitate our service, to provide the service on our behalf, to perform service-related services or to assist us in analyzing how our service is used. These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">6. Contact Us</h3>
                    <p class="text-muted mb-0 text-justify" style="line-height: 1.8;">
                        If you have any questions about this Privacy Policy, please contact us at <a href="contact.php" class="text-info text-decoration-none">support@quizmaster.com</a>.
                    </p>
                </div>
                <!-- Decorative BG -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-br from-transparent to-primary opacity-5 pointer-events-none z-0"></div>
            </div>

            <div class="text-center">
                <a href="index.php" class="btn btn-outline-light rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
