<?php
//A kiemelt kezelések szekció kezelésére szolgáló függvények 
//Adatbázis kapcsolat
require_once __DIR__ . '/db.php';
/**
 * Összes kategória lekérése.
 *
 * @return array Kategóriák listája.
 */
function getAllCategories(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM treatment_categories ORDER BY name ASC");
    return $stmt->fetchAll();
}

/**
 * Kategória ID alapján kezelések lekérése.
 *
 * @param int $categoryId Kategória azonosítója.
 * @return array Kezelések listája.
 */
function getTreatmentsByCategory(int $categoryId): array {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT * FROM highlighted_treatment WHERE category_id = ?");
    $stmt->execute([$categoryId]);
    return $stmt->fetchAll();
}

/**
 * Kategória neve ID alapján.
 *
 * @param int|null $categoryId Kategória azonosítója (vagy NULL, ha nincs).
 * @return string Kategória neve vagy "Nincs kategória".
 */
function getCategoryNameById(?int $categoryId): string {
    if ($categoryId === null) {
        return 'Nincs kategória';
    }

    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT name FROM treatment_categories WHERE id = ?");
    $stmt->execute([$categoryId]);
    $category = $stmt->fetch();
    return $category['name'] ?? 'Nincs kategória';
}

/**
 * Kiemelt kezelések lekérése. A főoldalon és az admin oldalon a kiemelt kezelések megjelenítése
 *
 * @return array A kiemelt kezelések tömbje a visszatérési érték.
 */
function getHighlightedTreatments(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM highlighted_treatment ORDER BY position ASC");
    return $stmt->fetchAll();
}

/**
 * Új kezelés hozzáadása kategóriával.
 *
 * @param string $title Kezelés neve.
 * @param string $description Kezelés leírása.
 * @param array $image Feltöltött kép adatai ($_FILES).
 * @param int|null $categoryId Kategória azonosítója.
 */
function addTreatment(string $title, string $description, array $image, ?int $categoryId = null): void {
    $pdo = getDbConnection();
    
    // Kép feldolgozása
    $imagePath = 'treatment_' . time() . '.jpg';
    move_uploaded_file($image['tmp_name'], __DIR__ . "/../assets/images/$imagePath");

    $stmt = $pdo->prepare("INSERT INTO highlighted_treatment (title, description, image_path, category_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $imagePath, $categoryId]);
}
/**
 * Kezelés frissítése.
 *
 * @param int $id Kezelés ID-je.
 * @param string $title Kezelés neve.
 * @param string $description Kezelés leírása.
 * @param array|null $image Feltöltött kép adatai ($_FILES), ha van.
 */
function updateTreatment(int $id, string $title, string $description, ?array $image = null, ?int $categoryId = null): void {
    $pdo = getDbConnection();
    $imagePath = null;

    if ($image && $image['tmp_name']) {
        $imagePath = 'treatment_' . time() . '.jpg';
        move_uploaded_file($image['tmp_name'], __DIR__ . "/../assets/images/$imagePath");
    }

    $query = "UPDATE highlighted_treatment SET title = ?, description = ?, category_id = ?";
    $params = [$title, $description, $categoryId];

    if ($imagePath) {
        $query .= ", image_path = ?";
        $params[] = $imagePath;
    }

    $query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
}
/**
 * Kezelés törlése.
 *
 * @param int $id Kezelés ID-je.
 */
function deleteTreatment(int $id): void {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM highlighted_treatment WHERE id = ?");
    $stmt->execute([$id]);
}