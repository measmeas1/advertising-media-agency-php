<?php
include 'config your database'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
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
            <a href="../dashboard.php"
               class="block p-3 rounded <?= ($currentPage=='dashboard')?'bg-blue-800':'hover:bg-blue-800' ?>">
                Dashboard
            </a>

            <a href="../products/index.php"
               class="block p-3 rounded <?= ($currentPage=='products')?'bg-blue-800':'hover:bg-blue-800' ?>">
                Products
            </a>

            <a href="index.php"
               class="block p-3 rounded <?= ($currentPage=='categories')?'bg-blue-800':'hover:bg-blue-800' ?>">
                Categories
            </a>

            <a href="../bookings/index.php"
               class="block p-3 rounded <?= ($currentPage=='bookings')?'bg-blue-800':'hover:bg-blue-800' ?>">
                Bookings
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">View Category</h2>
            <button onclick="openModal()"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Add Category
            </button>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Active</th>
                    </tr>
                </thead>
              <tbody>
                    
                        <?php
                     include_once('config.php');

                    $sql = "SELECT * FROM categories";
                    $retval = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($retval)) {
                        ?>
                        <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border"><?php echo $row['id']; ?></td>
                        <td class="p-2 border"><?php echo $row['name'];?></td>
                        <td class="p-2 border"><?php echo $row['status'];?></td>
                        <td class="p-2 border space-x-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    <?php
                    }
                     ?>
                        
                    </tr>
                <tbody> 
            </table>
        </div>
    </main>
</div>

<!-- ADD CATEGORY MODAL -->
<div id="addCategoryModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <!-- Close -->
        <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
            &times;
        </button>

        <?php include 'create.php'; ?>
    </div>
</div> 
<!-- JS -->
<script>
    function openModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }
</script>

</body>
</html>
