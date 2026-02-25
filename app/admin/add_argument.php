<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    if ($content) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO argument (content) VALUES (?)");
        $stmt->execute([$content]);
    }

    header("Location: ../admin/admin.php?success=argument_added");
    exit;
}