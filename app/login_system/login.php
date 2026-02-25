<?php
// 1. Session és konfigurációk betöltése - ITT MÉG NINCS KIMENET!
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/helper_functions.php';
require_once __DIR__ . '/auth_functions.php';
require_once __DIR__ . '/../config/admin_functions.php';
require_once __DIR__ . '/../constans/constans.php';

startSessionWithTimeout(900);

// 2. HA MÁR BE VAN JELENTKEZVE -> AZONNALI ÁTIRÁNYÍTÁS
if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "admin");
    exit;
}

$error = null;

// 3. POST FELDOLGOZÁS ÉS ÁTIRÁNYÍTÁS
// Ez a rész MINDENKÉPPEN a header.php betöltése előtt kell legyen!
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = handleLoginRequest();

    // Ha a handleLoginRequest null-t ad vissza, a login sikeres volt
    if ($error === null) {
        header("Location: " . BASE_URL . "admin");
        exit;
    }
}

$currentPage = 'Admin bejelentkezés';
$pageStylesheet = 'assets/styles/styles4.css';
?>
<!-- Admin Login -->
<header>
    <h1>Admin Bejelentkezés</h1>
</header>
<?php if ($error): ?>
    <p style="color: red;"><?= e($error); ?></p>
<?php endif; ?>
<form method="post" id="appointmentForm">
    <div class="form-group">
        <label for="email">Email cím:</label>
        <input type="email" id="email" name="email" placeholder="Email cím" required>
    </div>
    <div class="form-group">
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" placeholder="Jelszó" required>
    </div>
            
    <input type="submit" name="login" value="Belépés" class="btn click hover-effect">
</form>
<div class=" button hover-effect">
    <a href="<?= e(BASE_URL . 'home'); ?>">Vissza a főoldalra</a>
</div>