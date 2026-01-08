<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pageTitle = 'Terms of Service';
include_once 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-light mb-2">Terms of Service</h1>
                <p class="lead text-muted">Rules and agreements for using QuizMaster.</p>
            </div>

            <!-- Content Card -->
            <div class="glass-card border-0 shadow-lg position-relative overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5 text-light">
                    <p class="text-muted mb-5">Effective Date: <?php echo date('F d, Y'); ?></p>

                    <h3 class="fw-bold text-primary mb-3">1. Acceptance of Terms</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        By accessing or using QuizMaster, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">2. User Accounts</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        When you create an account with us, you must provide information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our service. You are responsible for safeguarding the password that you use to access the service and for any activities or actions under your password.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">3. Educational Content</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        The quizzes and educational materials provided on QuizMaster are for learning and assessment purposes. While we strive for accuracy, we do not guarantee that all content is free of errors. Report any discrepancies to our support team for review.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">4. Prohibited Conduct</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        You agree not to use the service to:
                        <ul class="text-muted mt-2">
                            <li>Violate any local, state, national, or international law.</li>
                            <li>Attempt to exploit vulnerabilities or bypass authentication measures.</li>
                            <li>Cheating or manipulating quiz scores through automated means.</li>
                            <li>Harass, abuse, or harm another person or group.</li>
                        </ul>
                    </p>

                    <h3 class="fw-bold text-primary mb-3">5. Intellectual Property</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        The Service and its original content, features, and functionality are and will remain the exclusive property of QuizMaster and its licensors. The Service is protected by copyright, trademark, and other laws.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">6. Termination</h3>
                    <p class="text-muted mb-4 text-justify" style="line-height: 1.8;">
                        We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. All provisions of the Terms which by their nature should survive termination shall survive termination.
                    </p>

                    <h3 class="fw-bold text-primary mb-3">7. Changes to Terms</h3>
                    <p class="text-muted mb-0 text-justify" style="line-height: 1.8;">
                        We reserve the right, at our sole discretion, to modify or replace these Terms at any time. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms.
                    </p>
                </div>
                <!-- Decorative BG -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-bl from-transparent to-primary opacity-5 pointer-events-none z-0"></div>
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
