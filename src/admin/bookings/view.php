<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die('Booking ID is required');
}

/* UPDATE STATUS */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_status'])) {
    $update = $pdo->prepare("
        UPDATE bookings 
        SET payment_status = ? 
        WHERE id = ?
    ");
    $update->execute([
        $_POST['payment_status'],
        $id
    ]);
}

/* FETCH BOOKING */
$sql = "
    SELECT 
        bookings.id,
        bookings.code,
        bookings.name,
        bookings.email,
        bookings.phone,
        bookings.message,
        bookings.payment_status,
        bookings.created_at,
        products.title AS product_title,
        products.price
    FROM bookings
    JOIN products ON bookings.product_id = products.id
    WHERE bookings.id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$booking) {
    die('Booking not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking #<?= $booking['id'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
</head>

<body class="bg-gray-100 font-sans">

<div class="max-w-4xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Booking Details</h2>
        <a href="index.php"
           class="px-4 py-2 border rounded-lg hover:bg-black hover:text-white transition">
            ← Back to Bookings
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6 space-y-6">

        <!-- BASIC INFO -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><strong class="text-gray-600">Booking ID:</strong> <strong><?= $booking['id'] ?></strong></div>
            <div><strong class="text-gray-600">Booking Code:</strong> <strong><?= htmlspecialchars($booking['code']) ?></strong></div>
            <div><strong class="text-gray-600">Date:</strong> <?= date('d M Y', strtotime($booking['created_at'])) ?></div>
            <div><strong class="text-gray-600">Product:</strong> <?= htmlspecialchars($booking['product_title']) ?></div>
        </div>

        <hr>

        <!-- CUSTOMER INFO -->
        <div>
            <h3 class="font-semibold text-lg mb-2">Customer Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><strong class="text-gray-600">Name:</strong> <?= htmlspecialchars($booking['name']) ?></div>
                <div><strong class="text-gray-600">Email:</strong> <?= htmlspecialchars($booking['email']) ?></div>
                <div><strong class="text-gray-600">Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></div>
            </div>
        </div>

        <hr>

        <!-- MESSAGE -->
        <div>
            <h3 class="font-semibold text-lg mb-2">Customer Message</h3>
            <p class="bg-gray-50 border rounded-lg p-4 text-gray-700">
                <?= nl2br(htmlspecialchars($booking['message'])) ?>
            </p>
        </div>

        <hr>

        <!-- PAYMENT & STATUS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <h3 class="font-semibold text-lg mb-2">Payment</h3>
                <p><strong class="text-gray-600">Price:</strong> $<?= number_format($booking['price'], 2) ?></p>
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-2">Payment Status</h3>

                <form method="POST">
                    <select name="payment_status"
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2 rounded border
                            <?php
                                echo match ($booking['payment_status']) {
                                    'paid' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-red-100 text-red-700',
                                };
                            ?>">
                        <option value="pending" <?= $booking['payment_status']=='pending'?'selected':'' ?>>Pending</option>
                        <option value="paid" <?= $booking['payment_status']=='paid'?'selected':'' ?>>Paid</option>
                        <option value="cancelled" <?= $booking['payment_status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                    </select>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
