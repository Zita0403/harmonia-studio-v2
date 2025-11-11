<?php
function getDbConnection():PDO {
    // Adatbázis kapcsolati adatok
    $servername = "localhost"; 
    $username = "root";        
    $password = "";            
    $dbname = "cosmetic_website_v2";  

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