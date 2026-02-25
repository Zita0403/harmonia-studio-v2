<?php
//Adatbázis kapcsolat
require_once __DIR__ . '/db.php'; 
// Home page section tartalom lekérése
function getSectionContent(string $sectionName):array {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT * FROM home_page_section WHERE section_name = ?");
    $stmt->execute([$sectionName]);
    return $stmt->fetch();
}
//Frissíti a home_page_section táblában egy szekció (welcome/about) tartalmát.
function updateSectionContent(string $sectionName, string $content) {
    if (empty($sectionName) || empty($content)) {
        throw new InvalidArgumentException("A szekció neve és a tartalom nem lehet üres.");
    }
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("UPDATE home_page_section SET content = ? WHERE section_name = ?");
    $stmt->execute([$content, $sectionName]);
}