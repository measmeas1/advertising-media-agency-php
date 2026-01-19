<?php
// Include database connection
include '../config.php'; // path to your database config

// Handle form submit
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
        // Redirect back to index.php after save
        header("Location: index.php");
        exit();
    } else {
        echo "Error: ". mysqli_error($conn);
    }
}
?>

<!-- FORM UI ONLY -->
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
        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
    </div>
</form>
