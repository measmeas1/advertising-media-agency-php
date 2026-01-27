<?php
session_start();
$pdo = require_once __DIR__ . '/../../config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$product_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user = $_SESSION['user'];

  $user_id = $user['id'];
  $name    = $user['name'];
  $email   = $user['email'];

  $phone   = $_POST['phone'];
  $message = $_POST['message'];

  $code = 'BK-' . strtoupper(uniqid());

  $stmt = $pdo->prepare("
      INSERT INTO bookings 
      (product_id, user_id, code, name, email, phone, message)
      VALUES (?, ?, ?, ?, ?, ?, ?)
  ");

  $stmt->execute([
      $product_id,
      $user_id,
      $code,
      $name,
      $email,
      $phone,
      $message
  ]);

  $_SESSION['success'] = "✅ Booking confirmed. We’ll contact you soon! Your booking code is <strong>$code</strong>.";
  header("Location: index.php");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

?>