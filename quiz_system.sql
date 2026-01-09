/* =========================================
   DATABASE CREATION
========================================= */

DROP DATABASE IF EXISTS quiz_system;
CREATE DATABASE quiz_system;
USE quiz_system;


/* =========================================
   TABLE: users
========================================= */

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Admin User */
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@quiz.com', 'adminPassword', 'admin');


/* =========================================
   TABLE: categories
========================================= */

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Categories */
INSERT INTO categories (name, description) VALUES
('General Knowledge', 'General knowledge questions from various fields'),
('Science', 'Physics, Chemistry, Biology and Environmental Science'),
('Mathematics', 'Algebra, Geometry, and Arithmetic'),
('History', 'World History and Historical Events');


/* =========================================
   TABLE: quizzes
========================================= */

CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category_id INT,
    time_limit INT DEFAULT 0 COMMENT 'Time in minutes',
    passing_score INT DEFAULT 50 COMMENT 'Percentage',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: questions
========================================= */

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text TEXT NOT NULL,
    question_type ENUM('multiple_choice', 'true_false') DEFAULT 'multiple_choice',
    marks INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: options
========================================= */

CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    option_text TEXT NOT NULL,
    is_correct TINYINT(1) DEFAULT 0,
    
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: quiz_attempts
========================================= */

CREATE TABLE quiz_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT DEFAULT 0,
    total_questions INT DEFAULT 0,
    correct_answers INT DEFAULT 0,
    started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: user_answers
========================================= */

CREATE TABLE user_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    question_id INT NOT NULL,
    selected_option_id INT,
    is_correct TINYINT(1) DEFAULT 0,
    
    FOREIGN KEY (attempt_id) REFERENCES quiz_attempts(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (selected_option_id) REFERENCES options(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: settings
========================================= */

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Settings */
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'QuizMaster'),
('maintenance_mode', '0');


/* =========================================
   TABLE: contact_messages
========================================= */

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   1. QUIZZES
========================================= */

INSERT INTO quizzes (title, description, category_id, time_limit, passing_score, created_by)
VALUES
(
    'Ultimate General Knowledge',
    'Test your knowledge about the world with this general trivia quiz. Good luck!',
    1, 15, 60, 1
),
(
    'Science & Nature Explorer',
    'Dive into the wonders of the natural world and scientific discoveries.',
    2, 20, 70, 1
);


/* =========================================
   2. QUESTIONS – QUIZ 1 (General Knowledge)
========================================= */

/* Q1 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'What is the capital city of France?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(1, 'London', 0),
(1, 'Berlin', 0),
(1, 'Paris', 1),
(1, 'Madrid', 0);


/* Q2 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'Which planet is known as the Red Planet?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(2, 'Venus', 0),
(2, 'Mars', 1),
(2, 'Jupiter', 0),
(2, 'Saturn', 0);


/* Q3 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'Who wrote the play "Romeo and Juliet"?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(3, 'Charles Dickens', 0),
(3, 'William Shakespeare', 1),
(3, 'Mark Twain', 0),
(3, 'Jane Austen', 0);


/* Q4 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'Which is the largest ocean on Earth?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(4, 'Atlantic Ocean', 0),
(4, 'Indian Ocean', 0),
(4, 'Arctic Ocean', 0),
(4, 'Pacific Ocean', 1);


/* Q5 (True / False) */
INSERT INTO questions (quiz_id, question_text, question_type) 
VALUES (
    1,
    'The Great Wall of China is visible from space with the naked eye.',
    'true_false'
);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(5, 'True', 0),
(5, 'False', 1);


/* Q6 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'What is the chemical symbol for Gold?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(6, 'Au', 1),
(6, 'Ag', 0),
(6, 'Fe', 0),
(6, 'Hg', 0);


/* Q7 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'Who painted the Mona Lisa?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(7, 'Vincent van Gogh', 0),
(7, 'Pablo Picasso', 0),
(7, 'Leonardo da Vinci', 1),
(7, 'Claude Monet', 0);


/* Q8 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'Which is the smallest continent by land area?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(8, 'Europe', 0),
(8, 'Antarctica', 0),
(8, 'Australia', 1),
(8, 'South America', 0);


/* Q9 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'What is the hardest natural substance on Earth?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(9, 'Gold', 0),
(9, 'Iron', 0),
(9, 'Diamond', 1),
(9, 'Platinum', 0);


/* Q10 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (1, 'What is the currency of Japan?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(10, 'Yuan', 0),
(10, 'Won', 0),
(10, 'Yen', 1),
(10, 'Dollar', 0);


/* =========================================
   3. QUESTIONS – QUIZ 2 (Science & Nature)
========================================= */

/* Q11 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'What is the "powerhouse" of the cell?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(11, 'Nucleus', 0),
(11, 'Mitochondria', 1),
(11, 'Ribosome', 0),
(11, 'Cytoplasm', 0);


/* Q12 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'At what temperature (Celsius) does water freeze?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(12, '0', 1),
(12, '100', 0),
(12, '32', 0),
(12, '-10', 0);


/* Q13 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'Which star is closest to Earth?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(13, 'Sirius', 0),
(13, 'Alpha Centauri', 0),
(13, 'The Sun', 1),
(13, 'Betelgeuse', 0);


/* Q14 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'How many bones are in the adult human body?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(14, '206', 1),
(14, '250', 0),
(14, '300', 0),
(14, '180', 0);


/* Q15 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'What gas do plants primarily use for photosynthesis?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(15, 'Oxygen', 0),
(15, 'Nitrogen', 0),
(15, 'Carbon Dioxide', 1),
(15, 'Hydrogen', 0);


/* Q16 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'Which is the largest mammal in the world?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(16, 'African Elephant', 0),
(16, 'Blue Whale', 1),
(16, 'Giraffe', 0),
(16, 'Hippopotamus', 0);


/* Q17 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'Which planet is famous for its extensive ring system?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(17, 'Jupiter', 0),
(17, 'Uranus', 0),
(17, 'Saturn', 1),
(17, 'Neptune', 0);


/* Q18 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'What represents the molecule H2O?');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(18, 'Salt', 0),
(18, 'Water', 1),
(18, 'Air', 0),
(18, 'Fire', 0);


/* Q19 */
INSERT INTO questions (quiz_id, question_text) 
VALUES (2, 'The study of plants is known as:');

INSERT INTO options (question_id, option_text, is_correct) VALUES
(19, 'Zoology', 0),
(19, 'Botany', 1),
(19, 'Geology', 0),
(19, 'Astronomy', 0);


/* Q20 (True / False) */
INSERT INTO questions (quiz_id, question_text, question_type) 
VALUES (
    2,
    'Humans breathe in Oxygen and breathe out Carbon Dioxide.',
    'true_false'
);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(20, 'True', 1),
(20, 'False', 0);
