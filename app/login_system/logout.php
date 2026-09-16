<?php
require_once __DIR__ . '/../../app/constans/constans.php';
require_once ROOT_PATH . 'app/config/session.php';

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
header("Location: " . BASE_URL . "login");
exit;