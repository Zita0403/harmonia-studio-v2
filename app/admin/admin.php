<?php
// Session indítása és ellenőrzés
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login");
    exit;
}

require_once __DIR__ . '/../config/admin_functions.php';
startSessionWithTimeout(900);
refreshSession(900); //15 perc session lejárat
ensureAdminLoggedIn();

// Adatbázis kapcsolat, konstansok
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/helper_functions.php'; //HTML karakterek biztonságos formázása kimenet előtt
require_once __DIR__ . '/../constans/constans.php';
require_once __DIR__ . '/../config/argument.php';
require_once __DIR__ . '/../config/section.php';
require_once __DIR__ . '/../controllers/business_logic.php';
// Adatok lekérése az adatbázisból
$welcome = getSectionContent('welcome');
$arguments = getAllArguments();
$categories = getAllCategories();
$highlightedTreatments = getHighlightedTreatments();
$about = getSectionContent('about');
// POST kérések kezelése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {
        handleAdminPostRequests($_POST, $_FILES);
        header("Location: " . BASE_URL . "admin/admin.php");
        exit;
    } else {
        error_log("Üres POST kérés érkezett az admin.php oldalra.");
    }
}
// Oldal neve és stílusa
$currentPage = 'Admin dashboard';
$pageStylesheet = 'assets/styles/styles5.css';
require_once __DIR__ . '/../includes/header.php'; 
?>
<!-- Navigációs sáv, későbbi kidolgozásra -->
<nav class="admin-sidebar">
    <ul class="admin-nav">
        <li><a href="">Kezelések módosítása</a></li>
        <li><a href="">Árlista módosítása</a></li>
        <li><a href="">Elérhetőségek módosítása</a></li>
        <li><a href="">Nyitvatartás módosítása</a></li>
        <li><a href="">További információk módosítása</a></li>
        <li><a href="<?php print BASE_URL . '/login_system/logout.php'; ?>">Kijelentkezés</a></li>
    </ul>
</nav>
<!-- üdvözlő üzenet -->
<section class="main-content">
    <header>
        <h1>Admin Dashboard</h1>
        <h3>Főoldal adatainak módosítása</h3>
        <p>Üdvözöllek, Admin!</p>
    </header>
    <!-- Főoldal üdvözlő üzenet módosítása -->
    <article>
        <h2>Üdvözölő üzenet módosítása</h2>
        <form action="" method="post">
            <input type="hidden" name="section_name" value="welcome">
            <textarea name="content" rows="5" required><?= e($welcome['content']); ?></textarea>
            <button type="submit" class="btn click hover-effect">Mentés</button>
        </form>
    </article>
    <!-- Főoldal érvek módosítása -->
    <article>
        <h2>Érvek szekció szerkesztése</h2>
        <!-- Meglévő érvek listája -->
        <ul id="argument-list">
            <?php foreach ($arguments as $argument): ?>
                <li>
                    <form action="" method="post" class="edit-form">
                        <input type="hidden" name="action" value="update_argument">
                        <input type="hidden" name="id" value="<?= $argument['id']; ?>">
                        <textarea name="content" required><?= e($argument['content']); ?></textarea>
                        <button type="submit" class="btn click hover-effect">Mentés</button>
                        <button type="submit" name="action" value="delete_argument" class="btn click hover-effect">Törlés</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- Új érv hozzáadása -->
        <form action="" method="post" class="add-form">
            <input type="hidden" name="action" value="add_argument">
            <div class="form-group">
                <label for="new-argument">Új érv hozzáadása:</label>
                <textarea id="new-argument" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn click hover-effect">Hozzáadás</button>
        </form>
    </article>
    <!-- Főoldal Kiemelt kezelések szekció módosítása -->
    <article>
        <h2>Kiemelt Kezelések szekció szerkesztése</h2>
        <?php foreach ($highlightedTreatments as $treatment): ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_treatment">
                <input type="hidden" name="id" value="<?= $treatment['id']; ?>">
                <input type="text" name="title" placeholder="Kezelés neve" value="<?= e($treatment['title']); ?>" required>
                <textarea name="description" rows="5" placeholder="Leírás" required><?= e($treatment['description']); ?></textarea>
                <select name="category_id">
                    <option value="">Válassz kategóriát</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= e($category['id']); ?>" <?= ($category['id'] == $treatment['category_id']) ? 'selected' : ''; ?>>
                    <?= e($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="file" name="image">
                <button type="submit" class="btn click hover-effect" name="action" value="update_treatment">Módosítás</button>
                <button type="submit" class="btn click hover-effect" name="action" value="delete_treatment">Törlés</button>
            </form>
        <!-- Új kezelés hozzáadása -->
        <?php endforeach; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_treatment">
            <input type="text" name="title" placeholder="Kezelés neve" required>
            <textarea name="description" rows="5" placeholder="Leírás" required></textarea>
            <select name="category_id">
                <option value="">Válassz kategóriát</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= e($category['id']); ?>"><?= e($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="file" name="image" required>
            <button type="submit" class="btn click hover-effect">Hozzáadás</button>
        </form>
    </article>
    <!-- Főoldal "Rólam" szekció módosítása -->
    <article>
        <h2>"Rólam" szekció szerkesztése</h2>
        <form action="" method="post">
            <input type="hidden" name="section_name" value="about">
            <textarea name="content" rows="10" required><?= e($about['content']); ?></textarea>
            <button type="submit" class="btn click hover-effect">Mentés</button>
        </form>
    </article>
</section>
<?php require_once __DIR__ . '/../includes/footer.php';?>