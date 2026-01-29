<?php
include('../session.php');
$pdo = require_once __DIR__ . '/../../config/db.php';

// DELETE PRODUCT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    // Delete product (product_details will be deleted automatically)
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php?deleted=1");
    exit;
}

// FETCH PRODUCTS WITH DETAILS
$sql = "SELECT p.*, c.name AS category_name, pd.id AS detail_id, pd.duration, pd.platform, pd.target_audience, pd.service_includes, pd.requirements, pd.delivery_time, pd.revisions, pd.notes, pd.image_url
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN product_details pd ON pd.product_id = p.id
        ORDER BY p.id ASC";
$products = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// FETCH CATEGORIES FOR ADD FORM
$catStmt = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC");
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../../assets/images/logo.png"> 
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white p-5">
        <div class="flex justify-left items-center mb-6">
            <img src="../../assets/images/logo.png" class="w-10 h-10">
            <h1 class="text-2xl font-bold">Advertising</h1>
        </div>
        <nav class="space-y-4">
            <a href="../dashboard/index.php" class="block hover:bg-blue-800 p-3 rounded">Dashboard</a>
            <a href="../customers/index.php" class="block p-3 rounded hover:bg-blue-800">Customers</a>
            <a href="index.php" class="block bg-blue-800 p-3 rounded">Products</a>
            <a href="../categories/index.php" class="block hover:bg-blue-800 p-3 rounded">Categories</a>
            <a href="../bookings/index.php" class="block hover:bg-blue-800 p-3 rounded">Bookings</a>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <?php include '../header.php'; ?>

        <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Products List</h2>
            <button onclick="window.location.href='create.php'" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add Product</button>
        </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Description</th>
                        <th class="p-2 border">Duration</th>
                        <th class="p-2 border">Platform</th>
                        <th class="p-2 border">Target Audience</th>
                        <th class="p-2 border">Delivery Time</th>
                        <th class="p-2 border">Revisions</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($products)): ?>
                    <tr>
                        <td colspan="11" class="p-4 text-center text-gray-500">No products found.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($products as $p): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border"><?= $p['id'] ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['category_name']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['title']) ?></td>
                        <td class="p-2 border">$<?= number_format($p['price'], 2) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['description']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['duration']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['platform']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['target_audience']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['delivery_time']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($p['revisions']) ?></td>
                        <td class="p-2 border flex gap-2">
                            <button onclick="window.location.href='edit.php?id=<?= $p['id'] ?>'" class="bg-yellow-600 text-white px-2 py-1 rounded">Edit</button>
                            <form method="POST" action="delete.php" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
