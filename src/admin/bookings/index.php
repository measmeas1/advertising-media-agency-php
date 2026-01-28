<?php
    $pdo = require_once __DIR__ . '/../../config/db.php';

     /* UPDATE STATUS */
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'], $_POST['payment_status'])) {
        $update = $pdo->prepare("
            UPDATE bookings 
            SET payment_status = ? 
            WHERE id = ?
        ");
        $update->execute([
        $_POST['payment_status'],
        $_POST['booking_id']
        ]);
    }

    /* DELETE BOOKING */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_booking_id'])) {
        $delete = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $delete->execute([$_POST['delete_booking_id']]);
    }


    $sql = "
        SELECT 
            bookings.id,
            products.title AS product_title,
            bookings.name,
            bookings.email,
            bookings.phone,
            bookings.message,
            bookings.payment_status
        FROM bookings
        JOIN products ON bookings.product_id = products.id
        ORDER BY bookings.id ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
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
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Message</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border"><?= $booking['id'] ?></td>
                    
                        <td class="p-2 border">
                            <?= htmlspecialchars($booking['product_title']) ?>
                        </td>
                    
                        <td class="p-2 border">
                            <?= htmlspecialchars($booking['name']) ?>
                        </td>

                        <td class="p-2 border">
                            <?= htmlspecialchars($booking['email']) ?>
                        </td>
                    
                        <td class="p-2 border">
                            <?= htmlspecialchars($booking['phone']) ?>
                        </td>
                    
                        <td class="p-2 border">
                            <?= htmlspecialchars($booking['message']) ?>
                        </td>
                    
                        <td class="p-2 border">
                            <form method="POST">
                                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">

                                <select name="payment_status"
                                        onchange="this.form.submit()"
                                        class="px-2 py-1 rounded text-sm border
                                        <?php
                                            echo match ($booking['payment_status']) {
                                                'Paid' => 'bg-green-100 text-green-700',
                                                'Partial' => 'bg-yellow-100 text-yellow-700',
                                                'Cancelled' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        ?>">
                                    <option value="Pending" <?= $booking['payment_status']=='Pending'?'selected':'' ?>>Pending</option>
                                    <option value="Paid" <?= $booking['payment_status']=='Paid'?'selected':'' ?>>Paid</option>
                                    <option value="Partial" <?= $booking['payment_status']=='Partial'?'selected':'' ?>>Partial</option>
                                    <option value="Cancelled" <?= $booking['payment_status']=='Cancelled'?'selected':'' ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                            
                        <td class="p-2 border flex gap-2">
                            <a href="view.php?id=<?= $booking['id'] ?>"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 flex items-center gap-1">
                                View
                            </a>

                            <!-- DELETE -->
                            <form method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                <input type="hidden" name="delete_booking_id" value="<?= $booking['id'] ?>">
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 flex items-center gap-1">
                                    Delete
                                </button>
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