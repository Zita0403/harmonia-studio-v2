<?php
require_once __DIR__ . '/../constans/constans.php';
/**
 * Ellenőrzi, hogy a felhasználó be van-e jelentkezve.
 * Ha nincs, átirányít a login oldalra.
 */
function ensureAdminLoggedIn(): void {
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "login_system/login.php");
        exit;
    }
}
/**
 * Session indítása és lejárati idő kezelése.
 *
 * @param int $timeout Lejárati idő 
 */
function startSessionWithTimeout(int $timeout = 900): void {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.gc_maxlifetime', $timeout);
        session_set_cookie_params([
            'lifetime' => $timeout,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']), 
            'httponly' => true,
            'samesite' => 'Strict' 
        ]);
        session_start();
    }
}
/**
 * Session frissítése aktivitás alapján.
 * Ha a session már lejárt, kijelentkezteti a felhasználót
 *
 * @param int $timeout Lejárati idő (15 perc)
 */
function refreshSession(int $timeout = 900): void {
    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $inactive = time() - $_SESSION['LAST_ACTIVITY'];
        error_log("Session ellenőrzés: $inactive másodperc telt el.");
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {
        error_log("Session lejárt, kijelentkeztetés...");
        session_unset();
        session_destroy();
        header("Location: ../login_system/login.php");
        exit;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}