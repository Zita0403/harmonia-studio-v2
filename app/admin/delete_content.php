<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';
    $table = $_GET['table'] ?? '';

    if ($id && in_array($table, ['argument', 'highlighted_treatment'])) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: ../admin/admin.php?success=content_deleted");
    exit;
}