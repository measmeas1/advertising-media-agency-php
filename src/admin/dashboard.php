<?php
include('session.php');
$pdo = require_once __DIR__ . '/../config/db.php';

/* =========================
   DASHBOARD STAT QUERIES
========================= */

// 1️⃣ Weekly Sales (PAID only)
$totalSalesStmt = $pdo->prepare("
    SELECT COALESCE(SUM(price), 0)
    FROM bookings
    WHERE payment_status = 'paid'
");
$totalSalesStmt->execute();
$totalSales = $totalSalesStmt->fetchColumn();

// 2️⃣ Total Products
$productCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

// 3️⃣ Total Categories
$bookingCount = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

// 4️⃣ Total Users (role user)
$userCountStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE role='user'");
$userCountStmt->execute();
$userCount = $userCountStmt->fetchColumn();

// 5️⃣ User purchase list
$userListStmt = $pdo->query("
    SELECT 
        u.id,
        u.name,
        u.email,
        b.phone,
        b.price,
        b.created_at,
        b.payment_status
    FROM users u
    INNER JOIN bookings b ON b.user_id = u.id
    WHERE 
        u.role = 'user'
    ORDER BY b.created_at ASC
    LIMIT 10
");
$users = $userListStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 flex-shrink-0 bg-blue-900 text-white p-5 flex flex-col">
        <h1 class="text-2xl font-bold mb-8">LOGO</h1>
        <nav class="space-y-4 flex-1">
            <a href="dashboard.php" class="block p-3 rounded hover:bg-blue-800 bg-blue-800">Dashboard</a>
            <a href="customers/index.php" class="block p-3 rounded hover:bg-blue-800">Customers</a>
            <a href="products/index.php" class="block p-3 rounded hover:bg-blue-800">Products</a>
            <a href="categories/index.php" class="block p-3 rounded hover:bg-blue-800">Categories</a>
            <a href="bookings/index.php" class="block p-3 rounded hover:bg-blue-800">Bookings</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT (Header + Stats/Table) -->
    <div class="flex-1 flex flex-col p-6">

        <!-- HEADER (inside main content, next to sidebar) -->
      <?php include 'header.php'?>

        <!-- STATS -->
        <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <div class="bg-blue-600 text-white p-5 rounded shadow">
                <p class="text-sm">Total Sales</p>
                <h3 class="text-2xl font-bold">$<?= number_format($totalSales, 2) ?></h3>
                <p class="text-xs">All paid bookings</p>
            </div>

            <div class="bg-yellow-600 text-white p-5 rounded shadow">
                <p class="text-sm">Total Products</p>
                <h3 class="text-2xl font-bold"><?= $productCount ?></h3>
                <p class="text-xs">All products</p>
            </div>

            <div class="bg-red-600 text-white p-5 rounded shadow">
                <p class="text-sm">Total Bookings</p>
                <h3 class="text-2xl font-bold"><?= $bookingCount ?></h3>
                <p class="text-xs">All bookings</p>
            </div>

            <div class="bg-green-600 text-white p-5 rounded shadow">
                <p class="text-sm">Total Users</p>
                <h3 class="text-2xl font-bold"><?= $userCount ?></h3>
                <p class="text-xs">All Customers</p>
            </div>

        </div>

        <!-- USER TABLE -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">User Purchases</h3>

            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="p-2 border">NO</th>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Phone</th>
                    <th class="p-2 border">Price</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Payment</th>
                </tr>
                </thead>

                <tbody>
                <?php if (count($users) === 0): ?>
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">
                            No purchases found
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($users as $index => $u): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2 border"><?= $index+1 ?></td>
                        <td class="p-2 border"><?= $u['id'] ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($u['name']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($u['phone'] ?? '-') ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($u['price'] ?? '-') ?></td>
                        <td class="p-2 border"><?= $u['created_at'] ? date('d M Y', strtotime($u['created_at'])) : '-' ?></td>
                        <td class="p-2 border font-semibold
                            <?php 
                                if ($u['payment_status'] === 'paid') echo 'text-green-600';
                                elseif ($u['payment_status'] === 'pending') echo 'text-yellow-600';
                                elseif ($u['payment_status'] === 'cancelled') echo 'text-red-600';
                            ?>">
                            <?= htmlspecialchars($u['payment_status']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>
