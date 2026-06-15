<?php
require_once __DIR__ . '/../constans/constans.php';
require_once __DIR__ . '/navigation.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Harmónia Stúdió Főoldal</title>  -->
    <title><?php print isset($currentPage) ? $currentPage : 'Harmónia Stúdió'; ?></title>
    <meta name="description" content="A Harmónia Stúdió egy kozmetikai kezelésekkel foglalkozó szépségszalon.">
    <meta name="keywords" content="szépségszalon, kozmetika, arckezelések, pigmentfolt halványítás, AHA savas hámlasztás, anti-age kezelés, mezoterápia, testkezelések, alakformáló-cellulit kezelés, feszesítő kezelés, szőreltávolítás, lézeres szőrtelenítés, szemöldök formázás, nappali smink, alkalmi smink, menyasszonyi smink">
    <meta name="author" content="Lukács Zita">
    <link rel="icon" href="<?= BASE_URL ?>logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php print BASE_URL . $pageStylesheet . '?v=2'; ?>">
</head>
<body>
<!-- Lap tetejére ugrás ikon -->
<button class="to-top" aria-label="Az oldal tetejére ugrás.">
    <i class="fa-chevron-up" aria-hidden="true"></i>
</button>
<!-- Elérhetőségek -->
<div class="first-nav">
    <ul class="contact-info">
        <li>+36 20 432-1234</li>
        <li>fiktivcim@gmail.com</li>
    </ul>
    <div class="brands-icons">
        <i class="fa-facebook"></i>
        <i class="fa-pinterest"></i>
        <i class="fa-square-instagram"></i>
    </div>
</div>
<!-- Az oldlal logo-ja -->
<nav>
    <div class="logo-container-1">
        <a href="<?= BASE_URL; ?>"><img src="<?= BASE_URL ?>assets/images/HS-logo.png" alt="Harmónia Stúdió logója" aria-label="Vissza a főoldalra."></a>
        
    </div>
    <!-- Az oldal menüje -->
    <ul class="main-menu">
        <?php foreach ($navItems as $item): ?>
            <li class="<?= isActive($item['url']); ?>">
                <a href="<?= BASE_URL . $item['url']; ?>"><?= $item['label']; ?></a>
                <?php if (!empty($item['submenu'])): ?>
                    <ul class="submenu">
                        <?php foreach ($item['submenu'] as $submenuItem): ?>
                            <li class="<?= isActive($submenuItem['url']); ?>">
                                <a href="<?= BASE_URL . $submenuItem['url']; ?>"><?= $submenuItem['label']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>   
    <!-- Mobil menü ikonok  -->
    <button class="hamburger-menu" aria-label="Mobil menü megnyitása">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>
    <!-- Mobil menü -->
    <ul class="hamburger-main-menu">
        <?php foreach ($navItems as $item): ?>
            <li class="<?= isActive($item['url']); ?>">
                <a href="<?= BASE_URL . $item['url']; ?>"><?= $item['label']; ?>
                    <?php if (!empty($item['submenu'])): ?>
                        <i class="fa-chevron-down toggle-submenu" aria-hidden="true"></i>
                    <?php endif; ?>
                </a>
                <?php if (!empty($item['submenu'])): ?>
                    <ul class="hamburger-submenu">
                        <?php foreach ($item['submenu'] as $submenuItem): ?>
                            <li class="<?= isActive($submenuItem['url']); ?>">
                                <a href="<?= BASE_URL . $submenuItem['url']; ?>"><?= $submenuItem['label']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<header>
<!-- Háttérkép -->
</header>
<main>