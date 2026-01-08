Here's a comprehensive prompt you can use with other AI tools to build your MCQ quiz system:

---

## **PROMPT FOR AI TOOL:**

Create a complete **Online MCQ Quiz System** in PHP with MySQL database. This should be a production-ready web application with the following specifications:

### **Technology Stack:**
- Backend: PHP 7.4+ with MySQLi or PDO
- Frontend: HTML5, CSS3, JavaScript (vanilla or jQuery)
- Database: MySQL
- Additional: Bootstrap 5 or Tailwind CSS for responsive design

### **Color Scheme (Premium Theme):**
```
/* Primary Colors */
--ink-black: #0D1B2A;           /* Main dark background, headers */
--prussian-blue: #1B263B;        /* Secondary background, cards */
--dusk-blue: #415A77;            /* Buttons, accents */
--dusty-denim: #778DA9;          /* Hover states, borders */
--alabaster-grey: #E0E1DD;       /* Light backgrounds, text on dark */

/* Semantic Colors */
--primary: #415A77;              /* Primary buttons, links */
--secondary: #778DA9;            /* Secondary elements */
--dark-bg: #0D1B2A;              /* Page background */
--card-bg: #1B263B;              /* Card backgrounds */
--light-text: #E0E1DD;           /* Text on dark backgrounds */
--muted-text: #778DA9;           /* Secondary text */

/* Status Colors */
--success: #10b981;              /* Green for correct answers */
--warning: #f59e0b;              /* Amber for warnings */
--danger: #ef4444;               /* Red for errors/incorrect */
--info: #3b82f6;                 /* Blue for information */

/* Gradients */
--gradient-primary: linear-gradient(135deg, #1B263B 0%, #415A77 100%);
--gradient-accent: linear-gradient(135deg, #415A77 0%, #778DA9 100%);
```

### **Design System Guidelines:Typography:**

Headings: Use bold weights with color #E0E1DD on dark backgrounds
Body text: Use #778DA9 for secondary text, #E0E1DD for primary text
Font sizes: Use a modular scale (14px, 16px, 18px, 24px, 32px, 48px)
Backgrounds:

Main page background: #0D1B2A
Cards/panels: #1B263B
Hover states: #415A77
Input fields: #1B263B with #778DA9 borders
Buttons:

Primary buttons: Background #415A77, text #E0E1DD
Hover: Background #778DA9
Secondary buttons: Border #778DA9, text #778DA9
Disabled: Background #1B263B, text #778DA9 with opacity
Cards:

Background: #1B263B
Border: 1px solid #415A77 (or transparent with subtle shadow)
Border-radius: 12px
Box-shadow: 0 4px 6px rgba(13, 27, 42, 0.3)
Hover effect: Lift with stronger shadow and border color #778DA9
Navigation:

Background: #1B263B
Active/hover: #415A77
Text: #E0E1DD
Border bottom: 2px solid #415A77 for active items
Forms:

Input background: #1B263B
Input border: #415A77
Focus border: #778DA9
Placeholder text: #778DA9 with reduced opacity
Label text: #E0E1DD

### **Database Structure:**
Create tables for:
1. **users** (id, username, email, password, role, created_at)
2. **quizzes** (id, title, description, category, time_limit, passing_score, created_by, created_at)
3. **questions** (id, quiz_id, question_text, question_type, marks, created_at)
4. **options** (id, question_id, option_text, is_correct)
5. **quiz_attempts** (id, user_id, quiz_id, score, total_questions, correct_answers, started_at, completed_at)
6. **user_answers** (id, attempt_id, question_id, selected_option_id, is_correct)
7. **categories** (id, name, description)

### **User Roles & Features:**

#### **STUDENT Features:**
1. **Registration & Login System**
   - Email verification (optional)
   - Password hashing (use password_hash())
   - Session management
   - Profile management

2. **Student Dashboard**
   - Display statistics: Total quizzes taken, average score, rank
   - Show available quizzes (grid/card layout)
   - Filter by category
   - Search functionality
   - Recent results section

3. **Quiz Taking Interface**
   - Display quiz details (title, description, time limit, total questions)
   - One question per page OR all questions on single page (configurable)
   - Timer countdown (if quiz is timed)
   - Progress bar showing completion percentage
   - Previous/Next navigation buttons
   - Flag/Mark for review option
   - Auto-submit when time expires
   - Confirmation dialog before final submission

4. **Results & History**
   - Immediate score display after submission
   - Percentage, grade, and pass/fail status
   - Detailed answer review with correct answers highlighted
   - Quiz history with date, score, and time taken
   - Option to retake quiz (if allowed)
   - Export results as PDF

5. **Leaderboard**
   - Top performers across all quizzes
   - Category-wise rankings
   - Monthly/all-time rankings

#### **ADMIN/TEACHER Features:**
1. **Admin Dashboard**
   - Total quizzes, questions, students statistics
   - Recent activities
   - Performance charts (use Chart.js)

2. **Quiz Management**
   - Create new quiz with:
     * Title, description, category
     * Time limit settings
     * Passing score percentage
     * Number of attempts allowed
     * Shuffle questions option
     * Show results immediately option
   - Edit existing quizzes
   - Delete quizzes
   - Publish/unpublish quizzes
   - Clone quiz functionality

3. **Question Bank Management**
   - Add questions with multiple choice options
   - Support for multiple correct answers
   - Mark correct answer(s)
   - Add images to questions (optional)
   - Bulk import questions from CSV/Excel
   - Organize questions by category/tags
   - Edit/delete questions

4. **Student Management**
   - View all registered students
   - Student performance analytics
   - Individual student quiz history
   - Activate/deactivate accounts
   - Export student data

5. **Reports & Analytics**
   - Quiz-wise performance reports
   - Student-wise performance reports
   - Question difficulty analysis
   - Export reports as PDF/Excel
   - Graphical representations

### **Page Structure & Navigation:**

#### **Public Pages:**
- `index.php` - Landing page with features, login/register buttons
- `login.php` - Login form
- `register.php` - Registration form
- `about.php` - About the system
- `contact.php` - Contact form

#### **Student Pages:**
- `student/dashboard.php` - Main dashboard
- `student/quizzes.php` - Browse all available quizzes
- `student/quiz-details.php?id=X` - View quiz information
- `student/take-quiz.php?id=X` - Quiz taking interface
- `student/results.php?attempt_id=X` - View results
- `student/history.php` - Quiz attempt history
- `student/leaderboard.php` - Rankings
- `student/profile.php` - Edit profile

#### **Admin Pages:**
- `admin/dashboard.php` - Admin dashboard
- `admin/quizzes.php` - Manage quizzes
- `admin/add-quiz.php` - Create new quiz
- `admin/edit-quiz.php?id=X` - Edit quiz
- `admin/questions.php?quiz_id=X` - Manage questions
- `admin/add-question.php` - Add new question
- `admin/students.php` - Student management
- `admin/reports.php` - View reports
- `admin/categories.php` - Manage categories

#### **Common/Includes:**
- `config/database.php` - Database connection
- `includes/header.php` - Common header
- `includes/footer.php` - Common footer
- `includes/navbar.php` - Navigation menu
- `includes/functions.php` - Helper functions
- `logout.php` - Logout handler

### **Design Requirements:**

1. **Responsive Design:**
   - Mobile-first approach
   - Works on tablets, mobile phones, and desktops
   - Collapsible sidebar for admin panel

2. **UI Components:**
   - Modern cards with subtle shadows (box-shadow: 0 1px 3px rgba(0,0,0,0.1))
   - Rounded corners (border-radius: 8-12px)
   - Smooth hover effects on buttons and cards
   - Loading spinners for AJAX operations
   - Toast notifications for success/error messages
   - Modal dialogs for confirmations
   - Clean, professional font (Inter, Poppins, or system fonts)

3. **Animations:**
   - Smooth page transitions
   - Button hover effects
   - Card hover lift effect
   - Progress bar animations
   - Fade-in effects for content loading

### **Security Requirements:**
- SQL injection prevention (use prepared statements)
- XSS protection (use htmlspecialchars())
- CSRF protection (use tokens)
- Password hashing (use password_hash() and password_verify())
- Session security (regenerate session IDs)
- Input validation on both client and server side
- Role-based access control
- Prevent direct URL access to restricted pages

### **Additional Features:**
- AJAX for smooth interactions without page reload
- Search functionality for quizzes
- Filter by category, difficulty
- Timer with visual countdown
- Auto-save answers (localStorage backup)
- Keyboard shortcuts (N for next, P for previous)
- Dark mode toggle (optional)
- Email notifications for quiz results
- Social sharing buttons for results

### **Code Quality:**
- Well-commented code
- Organized file structure
- Reusable functions
- Error handling with try-catch
- Clean, readable code following PSR standards
- No inline CSS/JavaScript (use external files)

### **Deliverables:**
1. Complete PHP application with all files
2. SQL file for database creation with sample data
3. README.md with installation instructions
4. Admin credentials (default: admin@quiz.com / admin123)
5. Configuration file template

### **File Structure:**
```
quiz-system/
├── config/
│   └── database.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   └── functions.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── admin/
│   ├── dashboard.php
│   ├── quizzes.php
│   ├── questions.php
│   └── ...
├── student/
│   ├── dashboard.php
│   ├── take-quiz.php
│   └── ...
├── index.php
├── login.php
├── register.php
├── logout.php
└── database.sql
```

Build this as a complete, functional system ready for deployment. Include inline documentation and comments explaining the code logic.

---

**Copy this entire prompt and paste it into your AI coding tool (like Claude, ChatGPT, Cursor, or any other coding assistant) to get the complete application built!**