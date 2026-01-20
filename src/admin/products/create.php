<?php

include '../config.php'; 


if(isset($_POST['save'])) {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
   

    // Insert into database
    $query = "INSERT INTO products (category_id, title, price, description) VALUES ('$category_id','$title','$price','$description')";
    $result = mysqli_query($conn, $query);

    if($result){
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
    <input type="text" name="category_id" placeholder="Category ID" class="p-2 border rounded w-full mb-3" required>
    <input type="text" name="title" placeholder="Title" class="p-2 border rounded w-full mb-3" required>
    <input type="number" name="price" placeholder="Price" class="p-2 border rounded w-full mb-3" required>
     <textarea name="description"
              placeholder="Description"
              class="p-2 border rounded w-full mb-3" required></textarea>
    
    <div class="flex space-x-2">
        <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
    </div>
</form>