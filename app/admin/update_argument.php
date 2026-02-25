<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $content = $_POST['content'] ?? '';

    $pdo = getDbConnection();

    if ($action === 'update' && $id && $content) {
        $stmt = $pdo->prepare("UPDATE argument SET content = ? WHERE id = ?");
        $stmt->execute([$content, $id]);
    } elseif ($action === 'delete' && $id) {
        $stmt = $pdo->prepare("DELETE FROM argument WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: ../admin/admin.php?success=argument_updated");
    exit;
}