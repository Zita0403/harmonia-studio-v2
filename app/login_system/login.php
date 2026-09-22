<?php 
    require_once __DIR__ . '/../../app/constans/constans.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "admin");
        exit;
    }

    $timeoutMessage = '';
    if (isset($_GET['reason']) && $_GET['reason'] === 'timeout') {
        $timeoutMessage = 'A munkamenet lejárt inaktivitás miatt. Kérjük, jelentkezzen be újra!';
        session_unset();
        session_destroy();
    }
?>
<!-- Admin Login -->
<header>
    <h1>Admin Bejelentkezés</h1>
</header>
<form method="post" id="appointmentForm">
    <?php if (isset($error)): ?>
        <p style="color: red; text-align: center;"><?= e($error); ?></p>
    <?php endif; ?>
    <div class="form-group">
        <label for="email">Email cím:</label>
        <input type="email" id="email" name="email" placeholder="Email cím" autocomplete="email" required>
    </div>
    <div class="form-group">
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" placeholder="Jelszó" required>
    </div>
            
    <input type="submit" name="login" value="Belépés" class="btn click hover-effect">
</form>
<a class=" button hover-effect" href="<?= e(BASE_URL . 'home'); ?>">Vissza a főoldalra</a>