<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];


if ($host === 'localhost' || $host === '127.0.0.1') {
    // Lokális
    // VirtualHost a public mappára mutat
    define('BASE_URL', $protocol . '://' . $host . '/');
} else {
    // ÉLES SZERVER (Amikor a tárhelyen fut)
    // A legtöbb szerveren a domain után nem kell mappa, csak egy /
    define('BASE_URL', $protocol . '://' . $host . '/');
}

// Projekt gyökérkönyvtár (app eléréshez)
define('ROOT_PATH', realpath(__DIR__ . '/../../') . '/');