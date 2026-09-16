<?php
require_once __DIR__ . '/../constans/constans.php';
/**
 * Ellenőrzi, hogy a felhasználó be van-e jelentkezve.
 * Ha nincs, átirányít a login oldalra.
 */
function ensureAdminLoggedIn(): void {
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "login");
        exit;
    }
}