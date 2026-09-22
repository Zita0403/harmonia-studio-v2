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
 * Segédfüggvény a kép mozgatásához a helyes target könyvtárba.
 */
function uploadTreatmentImage(array $image): string {
    if (empty($image['tmp_name']) || $image['error'] !== UPLOAD_ERR_OK) {
        error_log("Érvénytelen képfájl.");
    }

    // 1. Dinamikus kiterjesztés meghatározása (.webp, .jpg, .png stb.)
    $pathInfo = pathinfo($image['name']);
    $extension = strtolower($pathInfo['extension'] ?? 'webp');
    $rawFilename = $pathInfo['filename'];
    $cleanFilename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $rawFilename);

    if (empty($cleanFilename)) {
        $cleanFilename = 'image_' . time();
    }

    $imageName = $cleanFilename . '.' . $extension;

    // 2. Pontos célútvonal a public/assets/images könyvtárba
    $targetDir = realpath(__DIR__ . '/../../public/assets/images');

    if (!$targetDir) {
        // Fallback: Ha nincs külön public mappa
        $targetDir = realpath(__DIR__ . '/../../assets/images');
    }

    if (!$targetDir) {
        // Ha még nem létezik, automatikusan létrehozzuk
        $targetDir = __DIR__ . '/../../public/assets/images';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    }

    $fullDestination = $targetDir . DIRECTORY_SEPARATOR . $imageName;

    // 3. Fájl mozgatása a végső helyére
    if (!move_uploaded_file($image['tmp_name'], $fullDestination)) {
        error_log("Nem sikerült áthelyezni a képet ide: " . $fullDestination);
    }

    return $imageName;
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
    $imagePath = uploadTreatmentImage($image);  

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

    if ($image && !empty($image['tmp_name']) && $image['error'] === UPLOAD_ERR_OK) {
        $imagePath = uploadTreatmentImage($image);
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