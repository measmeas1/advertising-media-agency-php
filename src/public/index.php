<?php
    session_start();
    $pdo = require_once __DIR__ . '/../config/db.php';

    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? 'All';

    $sql = "
        SELECT 
            products.id,
            products.title,
            products.description,
            products.price,
            categories.name AS category
        FROM products
        JOIN categories ON products.category_id = categories.id
        WHERE products.title LIKE :search
    ";

    $params = [
        ':search' => "%$search%"
    ];

    if ($category !== 'All') {
        $sql .= " AND categories.name = :category";
        $params[':category'] = $category;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $catStmt = $pdo->query("SELECT name FROM categories WHERE status='active'");
    $catRows = $catStmt->fetchAll();

    $user = $_SESSION['user'] ?? null;
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
    <div class="flex justify-around items-center gap-4 px-6 py-4 bg-white shadow-sm">
        <div class="flex items-center">
            <img src="../assets/images/logo.png" alt="logo" width="50" height="50">
            <a href="index.php" class="text-xl font-bold text-black">
                AdServices
            </a>
        </div>
        <div class="flex items-center gap-6">
            <?php if ($user): ?>
                <span class="text-lg text-gray-600">
                    Welcome, <strong><?= htmlspecialchars($user['name']) ?></strong>
                </span>
                <a href="booking_list.php"
                    class="px-4 py-2 border rounded-lg hover:bg-black hover:text-white">
                    My Bookings
                </a>

                
                <button onclick="openLogoutModal()"
                class="bg-red-500 text-white font-bold px-4 py-2 rounded-lg hover:bg-red-600 transition">
                Logout
            </button>
            <?php else: ?>
                <a href="login.php"
                class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                Login
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="text-center bg-green-100 text-green-700 p-4 rounded mb-4">
        <?= $_SESSION['success']; ?>
      </div>
    <?php unset($_SESSION['success']); endif; ?>

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
            <a 
                href="?category=All" 
                class="px-4 py-2 rounded-full border hover:bg-black hover:text-white transition
                <?= $category === 'All'? 'bg-black text-white': 'hover:bg-black hover:text-white' ?>"
            >
                All
            </a>

            <?php foreach ($catRows as $cat): ?>
               <a 
                    href="?category=<?= urlencode($cat['name']) ?>"
                    class="px-4 py-2 rounded-full border hover:bg-black hover:text-white transition
                    <?= $category === $cat['name'] ? 'bg-black text-white' : 'hover:bg-black hover:text-white' ?>"
                >
                    <?= $cat['name'] ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">

        <?php if (!empty($services)): ?>
            <?php foreach ($services  as $row): ?>
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

    <!-- Logout Modal -->
    <div id="logoutModal"
         class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

      <div class="bg-white rounded-xl p-6 w-full max-w-sm">
        <h2 class="text-lg font-semibold mb-2">Confirm Logout</h2>
        <p class="text-gray-500 mb-6">Are you sure you want to logout?</p>

        <div class="flex justify-end gap-3">
          <button onclick="closeLogoutModal()"
            class="px-4 py-2 border rounded-lg hover:bg-gray-100">
            Cancel
          </button>

          <a href="logout.php"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            Logout
          </a>
        </div>
      </div>
    </div>

    <script>
    function openLogoutModal() {
      document.getElementById('logoutModal').classList.remove('hidden');
      document.getElementById('logoutModal').classList.add('flex');
    }
    function closeLogoutModal() {
      document.getElementById('logoutModal').classList.add('hidden');
    }
    </script>

</body>
</html>