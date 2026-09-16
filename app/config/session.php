<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', 900);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

$timeoutInSeconds = 1200;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeoutInSeconds)) {
    // Munkamenet törlése
    session_unset();
    session_destroy();

    // Munkamenet süti törlése a böngészőből
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Átirányítás az admin bejelentkezésre
    if (strpos($_SERVER['REQUEST_URI'], '/admin') === 0) {
        header("Location: /login.php?reason=timeout");
        exit;
    }
}

// Utolsó aktivitás időpontjának frissítése minden kérésnél
$_SESSION['last_activity'] = time();