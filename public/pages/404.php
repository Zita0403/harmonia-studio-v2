<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>404 - Az oldal nem található</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/styles/404.css">
</head>
<body>
    <div class="error-wrapper">
        <h1>404 - Az oldal nem található</h1>
        <div class="button-container">
             <a href="<?= BASE_URL ?>home">Vissza a főoldalra</a>
        </div>
    </div>
</body>
</html>