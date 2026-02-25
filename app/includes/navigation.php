<?php
require_once __DIR__ . '/../constans/constans.php'; // Constansok betöltése 
// Navigáció
$navItems = [
    [
        'label' => 'Főoldal',
        'url' => '' 
    ],
    [
        'label' => 'Szolgáltatások',
        'url' => '#',
        'submenu' => [
            ['label' => 'Arckezelések', 'url' => 'facial-treatment'],
            ['label' => 'Testkezelések', 'url' => 'body-treatment'],
            ['label' => 'Szőreltávolítás', 'url' => 'hair-removal'],
            ['label' => 'Sminkelés', 'url' => 'make-up'],
        ]
    ],
    ['label' => 'Árlista', 'url' => 'price-list'],
    ['label' => 'Rólam', 'url' => '#about'],
    ['label' => 'Kapcsolat', 'url' => '#contact'],
    ['label' => 'Időpontfoglalás', 'url' => 'booking'],
    ['label' => 'Admin', 'url' => 'login'],
];

// Aktuális oldal lekérése, ellenőrzés
function isActive($url) {
    $currentPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $urlPath = trim(parse_url($url, PHP_URL_PATH), '/');

    return $currentPath === $urlPath ? 'active' : '';
}



    