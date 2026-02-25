<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_FILES['image'] ?? null;

    $pdo = getDbConnection();

    if ($action === 'update' && $id) {
        $imagePath = '';
        if ($image && $image['tmp_name']) {
            $imagePath = 'treatment_' . time() . '.jpg';
            move_uploaded_file($image['tmp_name'], "../assets/images/$imagePath");
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