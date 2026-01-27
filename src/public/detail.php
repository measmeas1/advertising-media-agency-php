<?php
  $pdo = require_once __DIR__ . '/../config/db.php';

  $id = $_GET['id'] ?? null;

  if (!$id) {
      die("Service ID is required");
  }

  $sql = "
      SELECT 
          products.id,
          products.title,
          products.description,
          products.price,
          categories.name AS category,
          product_details.duration,
          product_details.platform,
          product_details.target_audience,
          product_details.service_includes,
          product_details.requirements,
          product_details.delivery_time,
          product_details.revisions,
          product_details.notes,
          product_details.image_url
      FROM products
      JOIN categories ON products.category_id = categories.id
      LEFT JOIN product_details ON product_details.product_id = products.id
      WHERE products.id = :id
  ";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]);
  $service = $stmt->fetch();

  if (!$service) {
      die("Service not found");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($service['title']) ?></title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 py-10">

    <!-- BACK BUTTON -->
    <a href="index.php"
       class="inline-flex items-center gap-2 px-4 py-2 border rounded-lg hover:bg-black hover:text-white transition">
      ← Back to Services
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-6">

      <!-- MAIN CONTENT -->
      <div class="lg:col-span-2 space-y-6">

        <!-- IMAGE HERO -->
        <div class="rounded-xl overflow-hidden border bg-white shadow-sm">
          <?php if (!empty($service['image_url'])): ?>
            <img src="<?= htmlspecialchars($service['image_url']) ?>"
                 class="w-full h-64 object-cover"
                 alt="<?= htmlspecialchars($service['title']) ?>">
          <?php else: ?>
            <div class="w-full h-64 flex items-center justify-center bg-gray-100 text-gray-400">
              No Image Available
            </div>
          <?php endif; ?>
        </div>

        <!-- TITLE -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
          <span class="inline-block bg-black text-white text-xs px-3 py-1 rounded-full">
            <?= htmlspecialchars($service['category']) ?>
          </span>

          <h1 class="text-3xl font-bold mt-4">
            <?= htmlspecialchars($service['title']) ?>
          </h1>

          <p class="text-gray-600 mt-3 leading-relaxed">
            <?= htmlspecialchars($service['description']) ?>
          </p>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="p-4 rounded-xl border bg-gray-50">
              <p class="text-sm text-gray-500">Duration</p>
              <p class="font-semibold"><?= htmlspecialchars($service['duration']) ?></p>
            </div>

            <div class="p-4 rounded-xl border bg-gray-50">
              <p class="text-sm text-gray-500">Platform</p>
              <p class="font-semibold"><?= htmlspecialchars($service['platform']) ?></p>
            </div>

            <div class="p-4 rounded-xl border bg-gray-50">
              <p class="text-sm text-gray-500">Audience</p>
              <p class="font-semibold"><?= htmlspecialchars($service['target_audience']) ?></p>
            </div>
          </div>
        </div>

        <!-- SERVICE INCLUDES -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
          <h2 class="font-semibold text-lg mb-4">What’s Included</h2>
          <p class="text-gray-700 leading-relaxed">
            <?= nl2br(htmlspecialchars($service['service_includes'])) ?>
          </p>
        </div>

        <!-- REQUIREMENTS -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
          <h2 class="font-semibold text-lg mb-4">Requirements</h2>
          <p class="text-gray-700 leading-relaxed">
            <?= nl2br(htmlspecialchars($service['requirements'])) ?>
          </p>
        </div>

        <!-- DELIVERY & NOTES -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
          <h2 class="font-semibold text-lg mb-4">Delivery & Notes</h2>
          <div class="space-y-3 text-gray-700">
            <p><strong>Delivery Time:</strong> <?= htmlspecialchars($service['delivery_time']) ?></p>
            <p><strong>Revisions:</strong> <?= htmlspecialchars($service['revisions']) ?></p>
            <p><strong>Notes:</strong> <?= nl2br(htmlspecialchars($service['notes'])) ?></p>
          </div>
        </div>

      </div>

      <!-- SIDEBAR -->
      <div>
        <div class="sticky top-24 bg-white border rounded-xl p-6 shadow-sm">
          <p class="text-2xl font-bold">$<?= number_format($service['price'], 2) ?></p>
          <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($service['category']) ?></p>

          <a href="booking.php?id=<?= $service['id'] ?>"
             class="block text-center bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition">
            Book Advertisement
          </a>

          <p class="text-xs text-gray-500 text-center mt-3">
            Login required to book.
          </p>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
