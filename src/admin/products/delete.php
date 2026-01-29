<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php?deleted=1");
    exit;
}
?>
