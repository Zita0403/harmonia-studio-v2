<?php

require_once __DIR__ . '/../config/argument.php';
require_once __DIR__ . '/../config/treatment.php';

/**
 * Az engedélyezett szekciónevek listájának lekérése.
 */
function getAllowedSections(): array {
    return ['welcome', 'about', 'argument_section'];
}

/**
 * Az admin oldal POST kéréseinek kezelése.
 */
function handleAdminPostRequests(array $post, array $files): void {
    $action = $post['action'] ?? null;

    if (!$action && isset($post['section_name'])) {
        processSectionUpdate($post);
        return;
    }

    if (!$action) {
        logErrorAndDisplay("Nincs megadva művelet.");
        return;
    }

    processAdminAction($action, $post, $files);
}

/**
 * Szekció tartalom frissítésének feldolgozása.
 */
function processSectionUpdate(array $post): void {
    $allowedSections = getAllowedSections();
    $sectionName = $post['section_name'];
    $content = $post['content'] ?? '';

    if (!in_array($sectionName, $allowedSections, true)) {
        logErrorAndDisplay("Érvénytelen szekciónév: $sectionName");
        return;
    }

    if ($content) {
        updateSectionContent($sectionName, $content);
    }
}

/**
 * Konkrét admin műveletek futtatása (csökkentett komplexitás).
 */
function processAdminAction(string $action, array $post, array $files): void {
    try {
        match ($action) {
            'update_argument'  => handleUpdateArgument($post),
            'delete_argument'  => handleDeleteArgument($post),
            'add_argument'     => addArgument($post['content'] ?? '', 2),
            'add_treatment'    => handleAddTreatment($post, $files),
            'update_treatment' => handleUpdateTreatment($post, $files),
            'delete_treatment' => handleDeleteTreatment($post),
            default            => logErrorAndDisplay("Ismeretlen művelet: $action"),
        };
    } catch (InvalidArgumentException $e) {
        logErrorAndDisplay("Hibás adat: " . $e->getMessage());
    } catch (Exception $e) {
        logErrorAndDisplay("Váratlan hiba: " . $e->getMessage());
    }
}

function handleUpdateArgument(array $post): void {
    $argumentId = validateRecordId($post['id'] ?? null);
    updateArgument($argumentId, $post['content'] ?? '');
}

function handleDeleteArgument(array $post): void {
    $argumentId = validateRecordId($post['id'] ?? null);
    deleteArgument($argumentId);
}

function handleAddTreatment(array $post, array $files): void {
    $categoryId = parseCategoryId($post['category_id'] ?? null);
    validateRequiredImage($files['image'] ?? []);
    addTreatment($post['title'] ?? '', $post['description'] ?? '', $files['image'], $categoryId);
}

function handleUpdateTreatment(array $post, array $files): void {
    $treatmentId = validateRecordId($post['id'] ?? null);
    $categoryId = parseCategoryId($post['category_id'] ?? null);
    validateOptionalImage($files['image'] ?? []);
    updateTreatment($treatmentId, $post['title'] ?? '', $post['description'] ?? '', $files['image'] ?? null, $categoryId);
}

function handleDeleteTreatment(array $post): void {
    $treatmentId = validateRecordId($post['id'] ?? null);
    deleteTreatment($treatmentId);
}

function parseCategoryId(mixed $rawCategoryId): ?int {
    return isset($rawCategoryId) && is_numeric($rawCategoryId) ? (int)$rawCategoryId : null;
}

/**
 * Hibaüzenet naplózása a rendszernaplóba.
 */
function logSystemError(string $message): void {
    error_log($message);
}

/**
 * Hibaüzenet naplózása és megjelenítése a felhasználónak.
 */
function logErrorAndDisplay(string $message): void {
    logSystemError($message);
    echo "Hiba történt. Kérjük, próbálja újra.";
}

/**
 * Érvényes rekord ID ellenőrzése.
 */
function validateRecordId(mixed $rawId): int {
    $validId = filter_var($rawId, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    if (!$validId) {
        throw new InvalidArgumentException("Érvénytelen ID: $rawId");
    }
    return $validId;
}

/**
 * Kötelező képfájl ellenőrzése.
 */
function validateRequiredImage(array $file): void {
    if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        throw new InvalidArgumentException("Nincs érvényes kép feltöltve.");
    }
    checkImageMimeType($file['tmp_name']);
}

/**
 * Opcionális képfájl ellenőrzése.
 */
function validateOptionalImage(array $file): void {
    if (empty($file['tmp_name'])) {
        return;
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        throw new InvalidArgumentException("A feltöltött fájl érvénytelen.");
    }
    checkImageMimeType($file['tmp_name']);
}

/**
 * MIME típus ellenőrzése finfo példányosítással (use finfo kivezetve).
 */
function checkImageMimeType(string $filePath): void {
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $fileType = null;

    if (class_exists('finfo')) {
        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $fileType = $fileInfo->file($filePath);
    }

    elseif (function_exists('mime_content_type')) {
        $fileType = mime_content_type($filePath);
    }

    elseif (function_exists('getimagesize')) {
        $imageInfo = @getimagesize($filePath);
        if ($imageInfo && isset($imageInfo['mime'])) {
            $fileType = $imageInfo['mime'];
        }
    }

    if (!$fileType) {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $extensionMap = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'webp' => 'image/webp'
        ];
        $fileType = $extensionMap[$ext] ?? null;
    }

    if (!in_array($fileType, $allowedMimeTypes, true)) {
        throw new InvalidArgumentException("Csak JPEG, PNG és WebP fájlok engedélyezettek.");
    }
}