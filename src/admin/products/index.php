<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <link href="../assets/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-8">LOGO</h1>

        <nav class="space-y-4">
            <a href="../dashboard.php" class="block hover:bg-blue-800 p-3 rounded">Dashboard</a>
            <a href="index.php" class="block bg-blue-800 p-3 rounded">Products</a>
            <a href="../product-details/index.php" class="block hover:bg-blue-800 p-3 rounded">Product Details</a>
            <a href="../categories/index.php" class="block hover:bg-blue-800 p-3 rounded">Categories</a>
            <a href="../bookings/index.php" class="block hover:bg-blue-800 p-3 rounded">Bookings</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Products List</h2>
            <button onclick="window.location.href='./create.php'" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    + Add Product
</button>

        </div>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Stock</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border">1</td>
                        <td class="p-2 border">Product A</td>
                        <td class="p-2 border">Category 1</td>
                        <td class="p-2 border">15</td>
                        <td class="p-2 border">$20</td>
                        <td class="p-2 border text-green-600">Active</td>
                        <td class="p-2 border space-x-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border">2</td>
                        <td class="p-2 border">Product B</td>
                        <td class="p-2 border">Category 2</td>
                        <td class="p-2 border">8</td>
                        <td class="p-2 border">$35</td>
                        <td class="p-2 border text-red-600">Out of Stock</td>
                        <td class="p-2 border space-x-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
