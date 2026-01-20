<?php

$bookings = [
    ['id'=>1, 'product_id'=>'Product A', 'customer_name'=>'meas', 'phone'=>'016998521','message'=>'hi', 'status'=>'Confirmed'],
    
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
      <link href="../assets/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-8">LOGO</h1>
        <nav class="space-y-4">
            <a href="../dashboard.php" class="block p-3 rounded hover:bg-blue-800">Dashboard</a>
            <a href="../products/index.php" class="block p-3 rounded hover:bg-blue-800">Products</a>
            <a href="../categories/index.php" class="block p-3 rounded hover:bg-blue-800">Categories</a>
            <a href="index.php" class="block p-3 rounded bg-blue-800">Bookings</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Bookings List</h2>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Product ID</th>
                        <th class="p-2 border">customer Name</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Message</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $booking): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border"><?= $booking['id'] ?></td>
                        <td class="p-2 border"><?= $booking['product_id'] ?></td>
                        <td class="p-2 border"><?= $booking['customer_name'] ?></td>
                        <td class="p-2 border"><?= $booking['phone'] ?></td>
                        <td class="p-2 border"><?= $booking['message'] ?></td>
                        <td class="p-2 border">
                            <span class="px-2 py-1 rounded <?= $booking['status']=='Confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                                <?= $booking['status'] ?>
                            </span>
                        </td>
                        <td class="p-2 border">
                            <a href="view.php?id=<?= $booking['id'] ?>" 
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</a>
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