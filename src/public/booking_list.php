<?php
session_start();
$pdo = require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user']['id'];

$stmt = $pdo->prepare("
    SELECT b.*, p.title, p.price
    FROM bookings b
    JOIN products p ON p.id = b.product_id
    WHERE b.user_id = ?
    ORDER BY b.created_at DESC
");
$stmt->execute([$userId]);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Bookings</title>
</head>
<body class="bg-gray-50">

<div class="max-w-6xl mx-auto px-6 py-10">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
      <h1 class="text-3xl font-bold mb-4">My Bookings</h1>
      <p class="text-gray-500 mb-8">Your booking history and invoices</p>
    </div>
    <div>
      <a href="index.php" class="px-4 py-2 border rounded-lg hover:bg-black hover:text-white">
        ← Back to Services
      </a>
    </div>
  </div>

  <?php if (empty($bookings)): ?>
    <div class="bg-white border rounded-xl p-6 text-center">
      <p class="text-gray-600">You don't have any bookings yet.</p>
      <a href="index.php" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-lg">
        Browse Services
      </a>
    </div>
  <?php else: ?>
    <div class="grid md:grid-cols-2 gap-6">
      <?php foreach ($bookings as $b): ?>
        <div class="bg-white border rounded-xl p-6 flex justify-between items-center">
          <div>
            <p class="font-semibold text-lg"><?= htmlspecialchars($b['title']) ?></p>
            <p class="text-sm text-gray-500 mt-1">
              Code: <span class="font-medium"><?= htmlspecialchars($b['code']) ?></span> • 
              <?= date('d M Y', strtotime($b['created_at'])) ?>
            </p>
            <p class="text-sm text-gray-500 mt-2">
              Price: <span class="font-semibold">$<?= number_format($b['price'], 2) ?></span>
            </p>

            <span class="text-xs px-3 py-1 rounded-full mt-3 inline-block
              <?= $b['payment_status'] === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
              <?= $b['payment_status'] ?>
            </span>
          </div>

          <a href="booking_view.php?code=<?= urlencode($b['code']) ?>"
             class="text-sm px-4 py-2 border rounded-lg hover:bg-black hover:text-white transition">
            View Invoice
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>

</body>
</html>
