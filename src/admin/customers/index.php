<?php
include('../session.php');
$pdo = require_once __DIR__ . '/../../config/db.php';

// Fetch ONLY customers
$stmt = $pdo->prepare("
    SELECT id, name, email, status, created_at
    FROM users
    WHERE role = 'user'
    ORDER BY created_at DESC
");
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Customers';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white p-5">
        <div class="flex justify-left items-center mb-6">
            <img src="../../assets/images/logo.png" class="w-10 h-10">
            <h1 class="text-2xl font-bold">Advertising</h1>
        </div>
        <nav class="space-y-4">
            <a href="../dashboard/index.php" class="block p-3 rounded hover:bg-blue-800">Dashboard</a>
            <a href="index.php" class="block p-3 rounded bg-blue-800">Customers</a>
            <a href="../products/index.php" class="block p-3 rounded hover:bg-blue-800">Products</a>
            <a href="../categories/index.php" class="block p-3 rounded hover:bg-blue-800">Categories</a>
            <a href="../bookings/index.php" class="block p-3 rounded hover:bg-blue-800">Bookings</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 p-6">

        <?php include '../header.php'; ?>

        <div class="bg-white p-6 rounded shadow overflow-x-auto">
            <h2 class="text-2xl font-semibold mb-6">Customer List</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">NO</th>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Joined</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$customers): ?>
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No customers found
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($customers as $index => $c): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2 border"><?= $index + 1?></td>
                        <td class="p-2 border"><?= $c['id'] ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($c['name']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($c['email']) ?></td>
                        <td class="p-2 border font-semibold <?= $c['status'] === 'active' ? 'text-green-600' : 'text-red-600' ?>">
                            <?= ucfirst($c['status']) ?>
                        </td>
                        <td class="p-2"><?= date('d M Y', strtotime($c['created_at'])) ?></td>
                        <td class="p-2 border text-left">
                            <form action="delete.php" method="POST" onsubmit="return confirm('Delete this customer?');">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
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
