<?php
session_start();

/**
 * Sanitize input data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if current user is admin
 */
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Redirect if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/QuizMaster/login.php');
    }

    // Verify user still exists in DB (prevents errors if DB was reset)
    global $pdo;
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    if (!$stmt->fetch()) {
        session_destroy();
        redirect('/QuizMaster/login.php?error=session_expired');
    }
}

/**
 * Redirect if not admin
 */
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        redirect('/QuizMaster/student/dashboard.php'); // Redirect non-admins to student dashboard
    }
}

/**
 * Redirect helper
 */
function redirect($url) {
    header("Location: " . $url);
    exit;
}

/**
 * Flash message helper
 */
function flash($name = '', $message = '', $class = 'success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'success';
            echo '<div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert">' . $_SESSION[$name] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Base URL helper
 */
function base_url($path = '') {
    return '/QuizMaster/' . ltrim($path, '/');
}
/**
 * Check Maintenance Mode
 */
function checkMaintenanceMode() {
    global $pdo;

    $current_script = basename($_SERVER['PHP_SELF']);
    $allowed_scripts = ['maintenance.php', 'login.php', 'register.php'];
    
    if (in_array($current_script, $allowed_scripts)) {
        return;
    }

    if (isAdmin()) {
        return;
    }

    try {
        if (isset($pdo)) {
            $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'maintenance_mode'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['setting_value'] === '1') {
                redirect('/QuizMaster/maintenance.php');
            }
        }
    } catch (PDOException $e) {
    }
}

function getSetting($key, $default = null) {
    global $pdo;
    try {
        if (isset($pdo)) {
            $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
            $stmt->execute([$key]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['setting_value'];
            }
        }
    } catch (PDOException $e) {
        // error
    }
    return $default;
}

function isRegistrationAllowed() {
    $val = getSetting('allow_registration', '1'); 
    return $val === '1';
}
?>
