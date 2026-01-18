<?php
// Include database connection
include '../config.php'; // make sure path is correct

if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Insert into database
    $query = "INSERT INTO products (name, category, stock, price, status) VALUES ('$name','$category','$stock','$price','$status')";
    $result = mysqli_query($conn, $query);

    if($result){
        // Redirect to index.php after save
        header("Location: index.php");
        exit();
    } else {
        echo "Error: ". mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" class="p-2 border rounded w-full mb-3" required>
        <input type="text" name="category" placeholder="Category" class="p-2 border rounded w-full mb-3" required>
        <input type="number" name="stock" placeholder="Stock" class="p-2 border rounded w-full mb-3" required>
        <input type="number" name="price" placeholder="Price" class="p-2 border rounded w-full mb-3" required>
        <select name="status" class="p-2 border rounded w-full mb-3" required>
            <option value="">Select Status</option>
            <option value="Active">Active</option>
            <option value="Out of Stock">Out of Stock</option>
        </select>
        <div class="flex space-x-2">
            <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
