<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/helper_functions.php';
require_once __DIR__ . '/auth_functions.php';
require_once __DIR__ . '/../config/admin_functions.php';
require_once __DIR__ . '/../constans/constans.php';

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