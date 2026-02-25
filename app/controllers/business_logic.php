<?php
require_once __DIR__ . '/../config/argument.php';
require_once __DIR__ . '/../config/treatment.php';
/**
 * Az engedélyezett szekciónevek listájának lekérése.
 *
 * @return array Az engedélyezett szekciók nevei.
 */
function getAllowedSections(): array {
    return ['welcome', 'about', 'argument_section'];
}
/**
 * Az admin oldal POST kéréseinek kezelése.
 *
 * @param array $post POST adatok.
 * @param array $files FILES adatok.
 */
function handleAdminPostRequests(array $post, array $files): void {
    $action = $post['action'] ?? null;

    // Ha nincs action, de van section_name, akkor szekció tartalom frissítés
    if (!$action && isset($post['section_name'])) {
        $allowedSections = getAllowedSections();
        $sectionName = $post['section_name'];
        $content = $post['content'] ?? '';

        if (!in_array($sectionName, $allowedSections, true)) {
            logError("Érvénytelen szekciónév: $sectionName", true);
            return;
        }

        if ($content) {
            updateSectionContent($sectionName, $content);
        }
        return;
    }
    // Az engedélyezett műveletek listája
    $allowedActions = [
        'update_argument',
        'delete_argument',
        'add_argument',
        'add_treatment',
        'update_treatment',
        'delete_treatment',
    ];

    // Ellenőrzés, hogy az action engedélyezett-e
    if (!in_array($action, $allowedActions, true)) {
        logError("Ismeretlen művelet: $action", true);
        return;
    }
    try {
        // Az action értéke alapján végrehajtandó műveletek
        switch ($action) {
            case 'update_argument':
                $id = validateId($post['id']);
                updateArgument($id, $post['content'] ?? '');
                break;

            case 'delete_argument':
                $id = validateId($post['id']);
                deleteArgument($id);
                break;

            case 'add_argument':
                addArgument($post['content'] ?? '', 2);
                break;

            case 'add_treatment':
                $categoryId = isset($post['category_id']) && is_numeric($post['category_id']) ? (int)$post['category_id'] : null;
                validateImage($files['image']);
                addTreatment($post['title'] ?? '', $post['description'] ?? '', $files['image'], $categoryId);
                break;

            case 'update_treatment':
                $id = validateId($post['id']);
                $categoryId = isset($post['category_id']) && is_numeric($post['category_id']) ? (int)$post['category_id'] : null;
                validateImage($files['image'], true);
                updateTreatment($id, $post['title'] ?? '', $post['description'] ?? '', $files['image'] ?? null, $categoryId);
                break;

            case 'delete_treatment':
                $id = validateId($post['id']);
                deleteTreatment($id);
                break;
        }
    } catch (InvalidArgumentException $e) {
        logError("Hibás adat: " . $e->getMessage(), true);
    } catch (Exception $e) {
        logError("Váratlan hiba: " . $e->getMessage(), true);
    }
}
/**
 * Hibaüzenet naplózása és megjelenítése.
 */
function logError(string $message, bool $showToUser = false): void {
    error_log($message);
    if ($showToUser) {
        echo "Hiba történt. Kérjük, próbálja újra.";
    }
}
/**
 * Érvényes ID ellenőrzése.
 */
function validateId($id): int {
    $validId = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    if (!$validId) {
        throw new InvalidArgumentException("Érvénytelen ID: $id");
    }
    return $validId;
}
/**
 * Fájl érvényességének ellenőrzése.
 */
function validateImage(array $file, bool $optional = false): void {
    if ($optional && empty($file['tmp_name'])) {
        return;
    }
    if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        throw new InvalidArgumentException("Nincs érvényes kép feltöltve.");
    }
    $allowedMimeTypes = ['image/jpeg', 'image/png'];
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $fileInfo->file($file['tmp_name']);

    if (!in_array($fileType, $allowedMimeTypes, true)) {
        throw new InvalidArgumentException("Csak JPEG és PNG fájlok engedélyezettek.");
    }
}