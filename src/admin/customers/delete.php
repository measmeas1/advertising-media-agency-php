<?php
include('../session.php');
$pdo = require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Delete ONLY customer users
$stmt = $pdo->prepare("
    DELETE FROM users 
    WHERE id = :id AND role = 'user'
");
$stmt->execute(['id' => $id]);

header('Location: index.php');
exit;
