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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Az oldalak stílusai, oldalanként változhat, változókba mentve -->
    <link rel="stylesheet" href="<?php print BASE_URL . $pageStylesheet; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
</head>
<body>
<!-- Lap tetejére ugrás ikon -->
<button class="to-top">
    <i class="fa-solid fa-chevron-up"></i>
</button>
<!-- Elérhetőségek -->
<div class="first-nav">
    <ul class="contact-info">
        <li>+36 20 432-1234</li>
        <li>fiktivcim@gmail.com</li>
    </ul>
    <div class="brands-icons">
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-pinterest"></i>
        <i class="fa-brands fa-square-instagram"></i>
    </div>
</div>
<!-- Az oldlal logo-ja -->
<nav>
    <div class="logo-container-1">
        <a href="<?= BASE_URL; ?>"><img src="<?= BASE_URL ?>assets/images/HS-logo.png" alt="Harmónia Stúdió logója"></a>
        
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
    <div class="hamburger-menu">
        <i class="fa-solid fa-bars"></i>
    </div>
    <!-- Mobil menü -->
    <ul class="hamburger-main-menu">
        <?php foreach ($navItems as $item): ?>
            <li class="<?= isActive($item['url']); ?>">
                <a href="<?= BASE_URL . $item['url']; ?>"><?= $item['label']; ?>
                    <?php if (!empty($item['submenu'])): ?>
                        <i class="fa-solid fa-chevron-down toggle-submenu"></i>
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