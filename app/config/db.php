<?php
$envFile = __DIR__ . '/../.env'; // alapértelmezett: szerver app/.env
if (file_exists(__DIR__ . '/../.env.local')) {
    $envFile = __DIR__ . '/../.env.local'; // helyi fejlesztéshez
}

// .env fájl betöltése
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

function getDbConnection(): PDO {
    $servername = getenv('DB_HOST');
    $username   = getenv('DB_USER');
    $password   = getenv('DB_PASS');
    $dbname     = getenv('DB_NAME');

    try {
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch (PDOException $e) {
        die("Adatbázis kapcsolat hiba: " . $e->getMessage());
    }
}