
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
            <a href="../categories/index.php" class="block hover:bg-blue-800 p-3 rounded">Categories</a>
            <a href="../bookings/index.php" class="block hover:bg-blue-800 p-3 rounded">Bookings</a>
        </nav>
    </aside>

   <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">
       <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Products List</h2>
            <button onclick="openModal()" name="save" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Add Product
            </button>


        </div>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Category ID</th>
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Description</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border">1</td>
                        <td class="p-2 border">1234</td>
                        <td class="p-2 border">computer</td>
                        <td class="p-2 border">$20</td>
                        <td class="p-2 border">Good</td>
                        <td class="p-2 border space-x-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>   
                <tbody>
                    
                        <?php
                     include_once('config.php');

                    $sql = "SELECT * FROM products";
                    $retval = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($retval)) {
                        ?>
                        <tr class="border-b hover:bg-gray-100">
                        <td class="p-2 border"><?php echo $row['id']; ?></td>
                        <td class="p-2 border"><?php echo $row['category_id'];?></td>
                        <td class="p-2 border"><?php echo $row['title'];?></td>
                        <td class="p-2 border"><?php echo $row['price'];?></td>
                        <td class="p-2 border"><?php echo $row['description'];?></td>
                        <td class="p-2 border space-x-2">
                           <button
                                onclick="window.location.href='edit.php?id=<?= $row['id'] ?>'"
                                class="bg-blue-500 text-white px-2 py-1 rounded">
                                Edit
                            </button>
                            <button
                                onclick="window.location.href='delete.php?id=<?= $row['id'] ?>'"
                                class="bg-red-500 text-white px-2 py-1 rounded">
                                Delete
                            </button>

                           
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

<!-- ADD PRODUCT MODAL -->
<div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <!-- Close button -->
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>

        <!-- Include the create.php form -->
         <?php
             include 'create.php';
         ?>
    </div>
</div>


<script>
    function openModal() {
        document.getElementById('addProductModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addProductModal').classList.add('hidden');
    }
</script>


</body>
</html>