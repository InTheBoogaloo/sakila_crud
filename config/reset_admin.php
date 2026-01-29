<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/db.php";

$newPassword = "admin123";
$hash = sha1($newPassword); // 👈 40 chars

$stmt = $conn->prepare(
    "UPDATE staff SET password = ? WHERE username = 'admin'"
);

$stmt->bind_param("s", $hash);
$stmt->execute();

echo "Password de admin actualizado (SHA1)";
