<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sectionName = $_POST['section_name'] ?? '';
    $content = $_POST['content'] ?? '';

    if ($sectionName && $content) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("UPDATE home_page_section SET content = ? WHERE section_name = ?");
        $stmt->execute([$content, $sectionName]);
    }

    header("Location: admin.php?success=section_updated");
    exit;
}