# QuizMaster - Online Quiz System

QuizMaster is a dynamic, web-based quiz application designed to facilitate online learning and assessment. It features a modern, glassmorphism-inspired UI and distinct roles for Students and Administrators.

## 🚀 How It Works

The application follows a standard **PHP Multi-Page Application (MPA)** architecture:

1.  **Authentication**: Users register or login. The system assigns a role (`admin` or `student`) based on the database record.
2.  **State Management**: PHP `$_SESSION` is used to track logged-in users and enforce access control (e.g., preventing students from accessing `/admin` pages).
3.  **Data Layer**: A `database.php` config file establishes a connection to the MySQL database using **PDO**, ensuring secure data transactions.
4.  **Frontend**: The UI is built with HTML/CSS (Bootstrap 5 + Custom CSS) and uses PHP to render dynamic content server-side.

## 🛠️ Technology Stack

-   **Backend**: Native PHP (8.x recommended)
-   **Database**: MySQL
-   **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
-   **Styling**: Bootstrap 5 (CDN), FontAwesome (Icons), Custom Glassmorphism Theme
-   **Architecture**: Logic-Separated Page Model (includes/components pattern)

## ✨ Features

### 🎓 Student Portal
-   **Dashboard**: View statistics (Total Attempts, Average Score, XP) and recent activity.
-   **Take Quizzes**: Interactive interface for Multiple Choice and True/False questions.
-   **History Timeline**: Visual timeline of past attempts with scores and pass/fail status.
-   **Leaderboard**: See top-performing students.
-   **Profile**: Manage account details (Overview, Security).

### 🛡️ Admin Portal
-   **Dashboard**: Overview of system health (Total Students, Active Quizzes, Question Bank).
-   **Quiz Management**: Create, edit, and delete quizzes. Add questions with specific point values.
-   **Student Management**: View registered students and their details.
-   **Reports**: detailed analytics of student performance.
-   **Settings**: Configure site-wide options.

## 📦 Setup & Installation

1.  **Prerequisites**:
    -   XAMPP/WAMP/MAMP (Apache + MySQL + PHP).
    -   Web Browser.

2.  **Installation**:
    -   Clone or extract the project to your web server root (e.g., `htdocs/QuizMaster`).
    -   Open `phpMyAdmin` and create a database named `quiz_system`.
    -   Import the `quiz_system.sql` file located in the project root.
    -   Configure database credentials in `config/database.php` (if changed from defaults).

3.  **Access**:
    -   Public/Student: `http://localhost/QuizMaster/`
    -   Admin: `http://localhost/QuizMaster/login.php`
    -   **Default Admin Credentials**:
        -   Username: `admin`
        -   Password: `adminPassword`

## 📊 Product Level Assessment

**Current Status:** **MVP (Minimum Viable Product) / Educational Prototype**

While fully functional and aesthetically polished, this project **is not yet enterprise product-level** in its current state. It works perfectly for small-scale deployments, school projects, or internal training tools.

### ⚠️ Why it's not "Product Level" yet:
1.  **Security**: While it uses PDO, enterprise apps require CSRF protection, stricter session management, and rate limiting. *Note: Password hashing should be robust (Bcrypt/Argon2).*
2.  **Scalability**: Native PHP sessions typically rely on the file system, which doesn't scale well across multiple servers without Redis/Memcached.
3.  **Testing**: There are no automated unit or feature tests (PHPUnit/Jest).
4.  **Dependency Management**: No `composer.json` or `package.json` for managing 3rd party libraries.

## 🚀 Recommended Future Extensions

To elevate this project further (e.g., for a top-tier final year project), consider implementing these features:

1.  **🔍 Search & Filter**:
    *   Add a real-time search bar and category dropdown on the "Browse Quizzes" page to help users find content faster.
2.  **📜 Certificate Generation**:
    *   Auto-generate a download-able PDF Certificate (using libraries like FPDF) when a student passes a quiz with >60% score.
3.  **⏱️ Real-Time Countdown Timer**:
    *   Add a visual countdown timer to the quiz interface that auto-submits the attempt when time runs out.
4.  **👤 Profile Customization**:
    *   Allow students to upload custom profile pictures instead of using default initials.
5.  **📨 Email Notifications**:
    *   Integrate PHPMailer to send "Welcome" emails upon registration and "Result" emails after quiz completion.

## 🛠️ Technical Improvements Roadmap

1.  **Security Hardening**: Implement **CSRF Tokens** for forms and robust **Password Hashing** (if not already strictly enforced).
2.  **Framework Migration**: Port to **Laravel** or **Symfony** for better routing, middleware, and ORM capabilities.
3.  **Real-Time Features**: Use **WebSockets** (Pusher/Socket.io) for live leaderboard updates.
4.  **API Layer**: Create a JSON REST API to support a future mobile app.

---
*Generated by QuizMaster Dev Team*
