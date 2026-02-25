/**
 * QuizMaster Form Validation & Enhancements
 */

document.addEventListener('DOMContentLoaded', function () {

    // 1. Password Visibility Toggle
    const toggleButtons = document.querySelectorAll('.password-toggle');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const input = this.previousElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // 2. Form Validation
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        // Skips delete account form which has special handling
        if (form.querySelector('input[name="confirm_delete"]')) return;

        form.addEventListener('submit', function (e) {
            let isValid = true;
            const inputs = form.querySelectorAll('input, textarea, select');

            inputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Real-time validation
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                validateInput(this);
            });
            input.addEventListener('input', function () {
                // Remove error as user types
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    const errorTag = this.parentElement.querySelector('.error-text');
                    if (errorTag) errorTag.innerText = '';
                }
            });
        });
    });
});

function validateInput(input) {
    const value = input.value.trim();
    const name = input.name;
    let errorMessage = '';
    let isValid = true;

    // Skip if not required and empty (unless specific logic)
    // We treat standard fields as implicitly required per user request
    const implicitlyRequired = [
        'username', 'email', 'password', 'confirm_password', 'name',
        'message', 'subject', 'new_password', 'confirm_delete',
        'title', 'question_text', 'site_name', 'category_id'
    ];

    if (!implicitlyRequired.includes(name) && !input.hasAttribute('required') && value === '') return true;

    // Required check
    if ((implicitlyRequired.includes(name) || input.hasAttribute('required')) && value === '') {
        // Customize message based on field name for better UX
        const fieldName = (name || 'Field').replace(/_/g, ' ').replace(/\[\]/g, '').replace(/\b\w/g, l => l.toUpperCase());
        errorMessage = `${fieldName} is required.`;
        isValid = false;
    }
    // Email Validation
    else if (input.type === 'email' || name === 'email') {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!emailRegex.test(value)) {
            errorMessage = "Invalid Email ID!! Email must be in (example@gmail.com) Format.";
            isValid = false;
        }
    }
    // Password Length (Registration/Change)
    else if ((name === 'password' || name === 'new_password') && value.length < 6) {
        if (input.form.querySelector('input[name="confirm_password"]')) { // Only check length on register/change, not login
            errorMessage = 'Password must be at least 6 characters.';
            isValid = false;
        }
    }
    // Confirm Password
    else if (name === 'confirm_password') {
        const passwordInput = input.form.querySelector('input[name="password"]') || input.form.querySelector('input[name="new_password"]');
        if (passwordInput && value !== passwordInput.value) {
            errorMessage = 'Passwords do not match.';
            isValid = false;
        }
    }

    // UI Updates
    const parent = input.closest('.premium-input-group') || input.parentElement;
    let errorTag = parent.querySelector('.error-text');

    // Create error tag if not exists
    if (!errorTag) {
        errorTag = document.createElement('p');
        errorTag.className = 'error-text text-danger small mt-1 mb-0 ms-2';
        parent.appendChild(errorTag);
    }

    if (!isValid) {
        input.classList.add('is-invalid');
        errorTag.innerText = errorMessage;
        return false;
    } else {
        input.classList.remove('is-invalid');
        errorTag.innerText = '';
        return true;
    }
}
