<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO categories (name, status)
        VALUES (?, ?)
    ");
    $stmt->execute([
        $_POST['name'],
        $_POST['status']
    ]);
}

header("Location: index.php");
exit;
