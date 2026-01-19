<?php
// Demo: fetch booking by ID (replace with DB query)
$id = $_GET['id'] ?? 1;
$booking = [
    'id'=>$id,
    'customer'=>'John Doe',
    'email'=>'john@example.com',
    'product'=>'Product A',
    'date'=>'2026-01-18',
    'status'=>'Confirmed',
    'quantity'=>2,
    'price'=>150
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Booking Details</h2>

    <div class="grid grid-cols-2 gap-4">
        <div><strong>Booking ID:</strong> <?= $booking['id'] ?></div>
        <div><strong>Customer:</strong> <?= $booking['customer'] ?></div>
        <div><strong>Email:</strong> <?= $booking['email'] ?></div>
        <div><strong>Product:</strong> <?= $booking['product'] ?></div>
        <div><strong>Date:</strong> <?= $booking['date'] ?></div>
        <div><strong>Status:</strong> 
            <span class="px-2 py-1 rounded <?= $booking['status']=='Confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                <?= $booking['status'] ?>
            </span>
        </div>
        <div><strong>Quantity:</strong> <?= $booking['quantity'] ?></div>
        <div><strong>Price:</strong> $<?= $booking['price'] ?></div>
    </div>

    <div class="mt-6">
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Bookings</a>
    </div>
</div>

</body>
</html>
