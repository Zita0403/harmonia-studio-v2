<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// 1. LÉPÉS: Bemeneti adatok és $_FILES ellenőrzése
    if (empty($_FILES)) {
        die("DEBUG 1: A $_FILES tömb teljesen üres! (Biztosan van enctype='multipart/form-data' és name='image' az inputon?)");
    }

    $image = $_FILES['image'] ?? null;

    if (!$image) {
        die("DEBUG 2: Nincs 'image' kulcsú fájl a $_FILES tömbben!");
    }

    if ($image['error'] !== UPLOAD_ERR_OK) {
        $uploadErrors = [
            1 => 'A fájl meghaladja a php.ini-ben beállított upload_max_filesize értéket.',
            2 => 'A fájl meghaladja a HTML form MAX_FILE_SIZE korlátját.',
            3 => 'A fájl csak részben töltődött fel.',
            4 => 'Nem lett fájl feltöltve.',
            6 => 'Hiányzik az ideiglenes mappa (tmp_dir).',
            7 => 'Nem sikerült lemezre írni a fájlt.',
            8 => 'Egy PHP kiterjesztés leállította a feltöltést.'
        ];
        $errorMsg = $uploadErrors[$image['error']] ?? 'Ismeretlen hiba';
        die("DEBUG 3: PHP Feltöltési Hiba (Kód: {$image['error']}): {$errorMsg}");
    }










    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    $pdo = getDbConnection();

    if ($action === 'update' && $id) {
        $imagePath = '';

        if ($image && !empty($image['tmp_name']) && $image['error'] === UPLOAD_ERR_OK) {
            
            $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($extension, $allowedExtensions, true)) {
                header("Location: ../admin/admin.php?error=invalid_image_type");
                exit;
            }

            $imageName = 'treatment_' . time() . '.' . $extension;

            $targetDirectory = realpath(__DIR__ . '/../public/assets/images');
            
            if (!$targetDirectory) {
                $targetDirectory = realpath(__DIR__ . '/../assets/images');
            }

            if (!$targetDirectory) {
                // Ha a mappa nem létezik, automatikusan létrehozzuk a public/assets/images mappát
                $targetDirectory = __DIR__ . '/../public/assets/images';
                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }
            }

            $fullDestination = $targetDirectory . DIRECTORY_SEPARATOR . $imageName;

            if (move_uploaded_file($image['tmp_name'], $fullDestination)) {
                $imagePath = $imageName;
            } else {
                error_log("Nem sikerült áthelyezni a képet ide: " . $fullDestination);
                die("A kép mozgatása sikertelen a céldirbe: " . $fullDestination);
            }
        }

        $query = "UPDATE highlighted_treatment SET title = ?, description = ?";
        $params = [$title, $description];

        if ($imagePath) {
            $query .= ", image_path = ?";
            $params[] = $imagePath;
        }

        $query .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

    } elseif ($action === 'delete' && $id) {
        $stmt = $pdo->prepare("DELETE FROM highlighted_treatment WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: ../admin/admin.php?success=treatment_updated");
    exit;
}