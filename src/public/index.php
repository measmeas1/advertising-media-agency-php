<?php
    require_once __DIR__ . '/service/index.php';
    $catStmt = $pdo->query("SELECT name FROM categories WHERE status='active'");
    $catRows = $catStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Advertising Services</title>
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold">Our Advertising Services</h1>
        <p class="text-gray-500 mt-2">
            Choose from our wide range of advertising solutions to grow your business
        </p>

        <!-- Search -->
        <form method="GET" class="mt-6">
            <input type="text" name="search" placeholder="Search services..."
                class="w-full md:w-1/3 border px-4 py-2 rounded-lg">
        </form>

        <!-- Categories -->
        <div class="flex flex-wrap gap-2 mt-6">
            <a href="?category=All" class="px-4 py-2 rounded-full border hover:bg-black hover:text-white transition">
                All
            </a>

            <?php foreach ($catRows as $cat): ?>
               <a href="?category=<?= urlencode($cat['name']) ?>"
                   class="px-4 py-2 rounded-full border hover:bg-black hover:text-white transition">
                    <?= $cat['name'] ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">

        <?php if ($result && $result->rowCount() > 0): ?>
            <?php foreach ($result as $row): ?>
                <div class="border rounded-xl p-6 bg-white shadow-sm hover:shadow-lg transition">

                    <h3 class="font-semibold text-lg">
                        <?= $row['title'] ?>
                    </h3>

                    <span class="inline-block bg-gray-100 text-sm px-3 py-1 rounded-full mt-2">
                        <?= $row['category'] ?>
                    </span>

                    <p class="text-gray-600 mt-4">
                        <?= $row['description'] ?>
                    </p>

                    <p class="text-2xl font-bold mt-6">
                        $
                        <?= $row['price'] ?>
                    </p>
                    <a href="detail.php?id=<?= $row['id'] ?>" class="block text-center">
                        <button class="mt-6 w-full bg-black text-white py-3 rounded-lg">View Details</button>
                    </a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 mt-10">No services found.</p>
        <?php endif; ?>

        </div>
    </div>
</body>

</html>