<?php
//Az érvek szekció kezelésére szolgáló függvények
//Adatbázis kapcsolat
require_once __DIR__ . '/db.php';
function getAllArguments(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM argument ORDER BY id ASC");
    return $stmt->fetchAll();
}
/**
 * Új érv hozzáadása egy szekcióhoz.
 *
 * @param string $content Az érv tartalma.
 * @param int $sectionId A szekció ID-je.
 */
function addArgument(string $content, int $sectionId): void {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("INSERT INTO argument (content) VALUES (?)");
    $stmt->execute([$content]);
    $newId = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO section_argument (section_id, argument_id) VALUES (?, ?)");
    $stmt->execute([$sectionId, $newId]);
}
/**
 * Érv módosítása.
 *
 * @param int $id Az érv ID-je.
 * @param string $content Az új tartalom.
 */
function updateArgument(int $id, string $content): void {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("UPDATE argument SET content = ? WHERE id = ?");
    $stmt->execute([$content, $id]);
}
/**
 * Érv törlése.
 *
 * @param int $id Az érv ID-ja.
 */
function deleteArgument(int $id): void {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM argument WHERE id = ?");
    $stmt->execute([$id]);
}