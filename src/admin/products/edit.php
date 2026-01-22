
    <?php
         include_once('config your database');
         $id=$_GET['id'];
         $query="SELECT * FROM products WHERE id='$id'";
         $result=mysqli_query($conn,$query);
            $row=mysqli_fetch_array($result);
         ?>

<!-- FORM UI ONLY -->

<h2 class="text-2xl font-semibold mb-4">Update Product</h2>

<form method="post" action="edit_product.php ?id=<?php echo $id; ?>" enctype= "multipart/form-data" <?php echo $row['id']; ?>>
    <input type="text" name="category_id" placeholder="Category ID" class="p-2 border rounded w-full mb-3" required value="<?php echo $row['category_id']; ?>">
    <input type="text" name="title" placeholder="Title" class="p-2 border rounded w-full mb-3" required value="<?php echo $row['title']; ?>">
    <input type="number" name="price" placeholder="Price" class="p-2 border rounded w-full mb-3" required value="<?php echo $row['price']; ?>">
    <textarea name="description" class="p-2 border rounded w-full mb-3" required>
        <?= $row['description']; ?>
    </textarea>

    
    <div class="flex space-x-2">
        <button type="submit" name="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
    </div>
</form>
