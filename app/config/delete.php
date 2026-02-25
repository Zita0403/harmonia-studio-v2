<?php
//Adatbázis kapcsolat
require_once __DIR__ . '/db.php';
// Adott táblából rekord törlése ID alapján
function deleteById($table, $id) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->execute([$id]);
}