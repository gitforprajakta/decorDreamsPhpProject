<?php
// Minimal admin authentication helper (userid/password)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ADMIN_USERID', 'admin');
// Password is: admin123
define('ADMIN_PASSWORD_HASH', '$2y$12$XB8itjvVxFG17YLlJqi/v.8o2YKfvS9f7ZVKRik8qgfzMQ5pngr2K');

function is_admin_logged_in() {
    return !empty($_SESSION['admin_user']) && $_SESSION['admin_user'] === ADMIN_USERID;
}

function require_admin_login() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function try_admin_login($userid, $password) {
    $userid = trim((string)$userid);
    if ($userid !== ADMIN_USERID) return false;
    if (!password_verify((string)$password, ADMIN_PASSWORD_HASH)) return false;
    $_SESSION['admin_user'] = ADMIN_USERID;
    return true;
}

function admin_logout() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

