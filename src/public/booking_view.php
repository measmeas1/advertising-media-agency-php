<?php
session_start();
$pdo = require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$code = $_GET['code'] ?? null;

$stmt = $pdo->prepare("
    SELECT b.*, p.title, p.price
    FROM bookings b
    JOIN products p ON p.id = b.product_id
    WHERE b.code = ? AND b.user_id = ?
");
$stmt->execute([$code, $_SESSION['user']['id']]);
$booking = $stmt->fetch();

if (!$booking) {
    die('Booking not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>
  <title>Booking Invoice</title>
</head>
<body class="bg-gray-50">

<div class="max-w-3xl mx-auto px-6 py-10">
  <a href="booking_list.php"
     class="inline-flex items-center gap-2 px-4 py-2 border rounded-lg hover:bg-black hover:text-white mb-4">
     ← Back to My Bookings
  </a>

  <div class="bg-white border rounded-xl p-8">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-2xl font-bold">Booking Invoice</h2>
        <p class="text-gray-500">Thank you for your booking!</p>
      </div>

      <div class="text-right">
        <p class="text-sm text-gray-500">Date</p>
        <p class="font-semibold"><?= date('d M Y', strtotime($booking['created_at'])) ?></p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-gray-50 p-4 rounded-lg">
        <p class="text-xs text-gray-500">Booking Code</p>
        <p class="font-semibold"><?= htmlspecialchars($booking['code']) ?></p>
      </div>

      <div class="bg-gray-50 p-4 rounded-lg">
        <p class="text-xs text-gray-500">Status</p>
        <p class="font-semibold"><?= htmlspecialchars($booking['payment_status']) ?></p>
      </div>
    </div>

    <hr class="my-6">

    <div class="space-y-3">
      <p><strong>Service:</strong> <?= htmlspecialchars($booking['title']) ?></p>
      <p><strong>Price:</strong> $<?= number_format($booking['price'], 2) ?></p>
      <p><strong>Name:</strong> <?= htmlspecialchars($booking['name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
    </div>

    <hr class="my-6">

    <div class="flex justify-between items-center">
      <p class="text-gray-500 text-sm">You will be contacted by our team soon.</p>
      <a href="javascript:window.print()"
         class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">
        Print Invoice
      </a>
    </div>
  </div>

</div>

</body>
</html>
