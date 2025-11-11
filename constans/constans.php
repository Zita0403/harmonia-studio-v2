<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$basePath = $protocol . "://" . $host . '/cosmetic_website_v2/';
define('BASE_URL', $basePath);
// Projekt gyökérkönyvtárának meghatározása
define('ROOT_PATH', realpath(__DIR__ . '/../') . '/'); // Egy szinttel feljebb lépés a constans mappából