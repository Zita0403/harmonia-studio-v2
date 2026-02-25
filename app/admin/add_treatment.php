<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_FILES['image'] ?? null;

    if ($title && $description && $image && $image['tmp_name']) {
        $imagePath = 'treatment_' . time() . '.jpg';
        move_uploaded_file($image['tmp_name'], "../assets/images/$imagePath");

        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO highlighted_treatment (title, description, image_path) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $imagePath]);
    }

    header("Location: ../admin/admin.php?success=treatment_added");
    exit;
}