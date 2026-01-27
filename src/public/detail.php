<?php
  require_once __DIR__ . '/service/detail.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $service['title'] ?></title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 py-10">

    <a href="index.php" class="text-sm text-gray-500 hover:text-black mb-6 inline-block">
      ← Back to Services
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <div class="lg:col-span-2 space-y-8">

        <div>
          <span class="inline-block bg-black text-white text-xs px-3 py-1 rounded-full">
            <?= $service['category'] ?>
          </span>

          <h1 class="text-3xl font-bold mt-3">
            <?= $service['title'] ?>
          </h1>

          <p class="text-gray-600 mt-2">
            <?= $service['description'] ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-white p-4 rounded-xl border">
            <p class="text-sm text-gray-500">Duration</p>
            <p class="font-semibold"><?= $service['duration'] ?></p>
          </div>

          <div class="bg-white p-4 rounded-xl border">
            <p class="text-sm text-gray-500">Platform</p>
            <p class="font-semibold"><?= $service['platform'] ?></p>
          </div>

          <div class="bg-white p-4 rounded-xl border">
            <p class="text-sm text-gray-500">Target Audience</p>
            <p class="font-semibold"><?= $service['target_audience'] ?></p>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl border">
          <h2 class="font-semibold text-lg mb-4">What's Included</h2>
          <ul class="space-y-3">
            <li class="flex gap-2"><span class="text-green-500">✔</span> Viral content strategy</li>
            <li class="flex gap-2"><span class="text-green-500">✔</span> Daily posting schedule</li>
            <li class="flex gap-2"><span class="text-green-500">✔</span> Trending sounds integration</li>
            <li class="flex gap-2"><span class="text-green-500">✔</span> Community engagement</li>
            <li class="flex gap-2"><span class="text-green-500">✔</span> Performance tracking</li>
          </ul>
        </div>

        <div class="bg-white p-6 rounded-xl border">
          <h2 class="font-semibold text-lg mb-4">How It Works</h2>
          <div class="space-y-4">
            <div>
              <h3 class="font-medium">Step 1: Submit Your Request</h3>
              <p class="text-sm text-gray-600">
                Click "Book Advertisement" to fill out the booking form.
              </p>
            </div>
            <div>
              <h3 class="font-medium">Step 2: Our Team Reviews</h3>
              <p class="text-sm text-gray-600">
                We’ll contact you within 24 hours.
              </p>
            </div>
            <div>
              <h3 class="font-medium">Step 3: Project Kickoff</h3>
              <p class="text-sm text-gray-600">
                Once approved, we begin your campaign.
              </p>
            </div>
          </div>
        </div>

      </div>

      <div>
        <div class="sticky top-24 bg-white border rounded-xl p-6 shadow-sm">
          <p class="text-2xl font-bold">$<?= $service['price'] ?></p>
          <p class="text-sm text-gray-500 mb-4"><?= $service['category'] ?></p>

          <a href="booking.php?id=<?= $service['id'] ?>"
             class="block text-center bg-black text-white py-3 rounded-lg hover:bg-gray-800">
            Book Advertisement
          </a>

          <p class="text-xs text-gray-500 text-center mt-3">
            No login required. We'll contact you to confirm details.
          </p>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
