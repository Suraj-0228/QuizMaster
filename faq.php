<?php
$pageTitle = 'FAQ';
include_once 'includes/header.php';
?>

<div class="row justify-content-center py-5">
    <div class="col-lg-8">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-light mb-3">Frequently Asked <span class="text-gradient">Questions</span></h1>
            <p class="text-muted lead">Everything you need to know about QuizMaster.</p>
        </div>

        <div class="accordion" id="faqAccordion">
            
            <!-- Item 1 -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed bg-transparent text-light shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <i class="fas fa-play-circle me-3 text-primary"></i> How do I start a quiz?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Once you log in as a student, navigate to the <strong>Dashboard</strong> or <strong>Available Quizzes</strong> page. Click on the "Take Quiz" button next to any quiz you wish to attempt. You'll be taken to the quiz interface immediately.
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed bg-transparent text-light shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-redo me-3 text-success"></i> Can I retake a quiz?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Yes, you can retake quizzes as many times as you like! Your <strong>History</strong> page will show all your attempts, but typically your best score or latest attempt is highlighted on the leaderboard, depending on the specific quiz settings.
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed bg-transparent text-light shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         <i class="fas fa-calculator me-3 text-warning"></i> How is my score calculated?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Most quizzes award <strong>1 point per correct answer</strong>. Some specialized quizzes may have different weighting (e.g., 2 points for hard questions). Your final percentage is calculated based on the total points available versus what you earned.
                    </div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed bg-transparent text-light shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="fas fa-lock me-3 text-danger"></i> I forgot my password. How can I reset it?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Currently, you can reset your password by contacting the administrator via the <a href="contact.php" class="text-primary text-decoration-none">Contact Us</a> page. We are working on an automated email reset feature which will be available soon.
                    </div>
                </div>
            </div>
            
            <!-- Item 5 -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed bg-transparent text-light shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="fas fa-user-shield me-3 text-info"></i> Is my data secure?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Absolutely. We use industry-standard encryption for data transmission and storage. Your personal information and quiz results are private and visible only to you and authorized administrators.
                    </div>
                </div>
            </div>

        </div>
        
        <div class="text-center mt-5">
            <p class="text-muted">Still have questions?</p>
            <a href="contact.php" class="btn btn-primary rounded-pill px-4">Contact Support</a>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.1);
}
.accordion-button::after {
    filter: invert(1);
    opacity: 0.5;
    transition: all 0.3s ease;
}
.accordion-button:not(.collapsed) {
    background-color: rgba(65, 90, 119, 0.1);
    color: white !important;
}
.accordion-button:not(.collapsed)::after {
    filter: invert(1);
    opacity: 1;
    transform: rotate(180deg);
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(119, 141, 169, 0.3);
}
</style>

<?php include_once 'includes/footer.php'; ?>
