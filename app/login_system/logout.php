<?php
require_once __DIR__ . '/../../app/constans/constans.php';
session_start();
session_destroy();
header("Location: " . BASE_URL . "login");
exit;