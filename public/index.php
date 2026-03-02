<?php
ob_start();
session_start();
require_once __DIR__ . '/../app/constans/constans.php';

// URL feldolgozás
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$path = str_replace($scriptName, '', $requestUri);
$path = trim($path, '/');
$path = preg_replace('/\.php$/', '', $path);
$path = str_replace('pages/', '', $path);

if ($path === 'admin/admin') {
    $path = 'admin';
}

// Ha üres → home
if ($path === '' || $path === 'index' || $path === 'home') {
    $path = 'home';
}

// Útvonalak és fájlok meghatározása
if ($path === 'login') {
    $pageFile = ROOT_PATH . 'app/login_system/login.php';
    $currentPage = 'Admin bejelentkezés';
    $pageStylesheet = 'assets/styles/styles4.css';
} elseif ($path === 'logout') {
    $pageFile = ROOT_PATH . 'app/login_system/logout.php';
} elseif ($path === 'admin') {
    $pageFile = ROOT_PATH . 'app/admin/admin.php';
    $currentPage = 'Admin dashboard';
    $pageStylesheet = 'assets/styles/styles5.css';
} else {
    $pageFile = __DIR__ . '/pages/' . $path . '.php';

    // Oldal cím és CSS
    switch ($path) {
        case 'home':
            $currentPage = 'Főoldal';
            $pageStylesheet = 'assets/styles/styles1.css';
            break;
        case 'facial-treatment':
            $currentPage = 'Arckezelések';
            $pageStylesheet = 'assets/styles/styles2.css';
            break;
        case 'body-treatment':
            $currentPage = 'Testkezelések';
            $pageStylesheet = 'assets/styles/styles2.css';
            break;
        case 'hair-removal':
            $currentPage = 'Szőreltávolítás';
            $pageStylesheet = 'assets/styles/styles2.css';
            break;
        case 'make-up':
            $currentPage = 'Sminkelés';
            $pageStylesheet = 'assets/styles/styles2.css';
            break;
        case 'price-list':
            $currentPage = 'Árlista';
            $pageStylesheet = 'assets/styles/styles3.css';
            break;
        case 'booking':
            $currentPage = 'Időpontfoglalás';
            $pageStylesheet = 'assets/styles/styles4.css';
            break;
        case 'cookie-policy':
            $currentPage = 'Süti szabályzat';
            $pageStylesheet = 'assets/styles/styles6.css';
            break;
        default:
            $currentPage = ucfirst(str_replace('-', ' ', $path));
            $pageStylesheet = 'assets/styles/styles1.css';
    }
}

// Konfigurációk betöltése
require_once ROOT_PATH . 'app/config/db.php';
require_once ROOT_PATH . 'app/config/argument.php';
require_once ROOT_PATH . 'app/config/treatment.php';
require_once ROOT_PATH . 'app/config/section.php';
require_once ROOT_PATH . 'app/config/helper_functions.php';

// Login feldolgozás
if ($path === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once ROOT_PATH . 'app/login_system/auth_functions.php';
    $error = handleLoginRequest();
if ($error === null) {
        header("Location: " . BASE_URL . "admin");
        exit;
    }
}

// Admin védelem
if ($path === 'admin' && !isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login");
    exit;
}

// NORMÁL MEGJELENÍTÉS (Header + Tartalom + Footer)
if (file_exists($pageFile)) {
    // Tartalmak lekérése az adatbázisból
    $welcome = getSectionContent('welcome'); 
    $arguments = getAllArguments(); 
    $categories = getAllCategories();
    $highlightedTreatments = getHighlightedTreatments();
    $about = getSectionContent('about');

    require_once ROOT_PATH . 'app/includes/header.php'; // HTML kimenet itt indul
    require $pageFile;
    require_once ROOT_PATH . 'app/includes/footer.php';
} else {
    http_response_code(404);
    require_once __DIR__ . '/pages/404.php';
}
ob_end_flush();