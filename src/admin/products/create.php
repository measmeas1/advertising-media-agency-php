<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

// Fetch categories for the dropdown
$catStmt = $pdo->prepare("SELECT id, name FROM categories ORDER BY name ASC");
$catStmt->execute();
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category_id = $_POST['category_id'];
    $title = trim($_POST['title']);
    $price = $_POST['price'];
    $description = trim($_POST['description']);

    $stmt = $pdo->prepare("INSERT INTO products (category_id, title, price, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$category_id, $title, $price, $description]);

    $product_id = $pdo->lastInsertId();

    $duration = $_POST['duration'];
    $platform = $_POST['platform'];
    $target_audience = $_POST['target_audience'];
    $service_includes = $_POST['service_includes'];
    $requirements = $_POST['requirements'];
    $delivery_time = $_POST['delivery_time'];
    $revisions = $_POST['revisions'];
    $notes = $_POST['notes'];

    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'product_' . time() . '.' . $ext;
        $destination = __DIR__ . '/../../public/assets/images/products/' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $image_url = $filename;
        }
    }

    $detailStmt = $pdo->prepare("
        INSERT INTO product_details 
        (product_id, duration, platform, target_audience, service_includes, requirements, delivery_time, revisions, notes, image_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $detailStmt->execute([
        $product_id,
        $duration,
        $platform,
        $target_audience,
        $service_includes,
        $requirements,
        $delivery_time,
        $revisions,
        $notes,
        $image_url
    ]);

    header("Location: index.php?added=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen flex flex-col lg:flex-row">
    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">

            <h2 class="text-3xl font-bold mb-6 text-gray-800">Add New Product</h2>

            <form method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-6">

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Category</label>
                        <select name="category_id" required class="w-full border rounded p-2">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Title</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Price</label>
                        <input type="number" name="price" step="0.01" class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium text-gray-700">Description</label>
                        <textarea name="description" class="w-full border rounded p-2" rows="3"></textarea>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="border-t pt-6 space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Product Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Duration</label>
                            <input type="text" name="duration" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Platform</label>
                            <input type="text" name="platform" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Target Audience</label>
                            <input type="text" name="target_audience" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Delivery Time</label>
                            <input type="text" name="delivery_time" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Revisions</label>
                            <input type="number" name="revisions" value="0" class="w-full border rounded p-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium text-gray-700">Service Includes</label>
                            <textarea name="service_includes" class="w-full border rounded p-2" rows="2"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium text-gray-700">Requirements</label>
                            <textarea name="requirements" class="w-full border rounded p-2" rows="2"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium text-gray-700">Notes</label>
                            <textarea name="notes" class="w-full border rounded p-2" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                        Save Product
                    </button>
                </div>
            </form>

        </div>
    </main>
</div>

</body>
</html>
