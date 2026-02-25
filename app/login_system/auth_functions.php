<?php
require_once __DIR__ . '/../config/db.php';
/**
 * Felhasználó hitelesítése e-mail és jelszó alapján.
 *
 * @param string $email Felhasználó e-mail címe.
 * @param string $password Felhasználó jelszava.
 * @return bool TRUE, ha a hitelesítés sikeres, egyébként FALSE.
 */
function authenticateUser(string $email, string $password): bool {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM login_data WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        error_log("Sikeres bejelentkezés: " . $email); 
        return true;
    }
    error_log("Sikertelen bejelentkezés: " . $email); 
    return false;
}
/**
 * Bejelentkezési POST kérés kezelése.
 *
 * @return string|null Hibás adat esetén hibaüzenet, egyébként NULL.
 */
function handleLoginRequest(): ?string {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            return "Minden mezőt ki kell tölteni!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Hibás e-mail vagy jelszó!";
        }

        if (authenticateUser($email, $password)) {
            return null; // siker
        }
            
        return "Hibás e-mail vagy jelszó!";
    }

    return null;
}