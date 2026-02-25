<?php
// Jelszó az admin belépéshez
$password = 'Admin!123'; 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// print "Hashelt jelszó: " . $hashedPassword;