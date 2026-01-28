<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

// GET PRODUCT ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// FETCH PRODUCT + DETAILS
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare("SELECT * FROM product_details WHERE product_id=?");
$stmt2->execute([$id]);
$details = $stmt2->fetch(PDO::FETCH_ASSOC);

// FETCH CATEGORIES
$categories = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $duration = $_POST['duration'];
    $platform = $_POST['platform'];
    $target_audience = $_POST['target_audience'];
    $service_includes = $_POST['service_includes'];
    $requirements = $_POST['requirements'];
    $delivery_time = $_POST['delivery_time'];
    $revisions = $_POST['revisions'];
    $notes = $_POST['notes'];
    $image_url = $details['image_url'] ?? null;

    // Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'product_' . time() . '.' . $ext;
        $destination = __DIR__ . '/../../public/assets/images/products/' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $image_url = $filename;
        }
    }

    // UPDATE PRODUCTS
    $stmt = $pdo->prepare("UPDATE products SET category_id=?, title=?, price=?, description=? WHERE id=?");
    $stmt->execute([$category_id, $title, $price, $description, $id]);

    // CHECK IF DETAILS EXIST
    if ($details) {
        $stmt = $pdo->prepare("UPDATE product_details SET duration=?, platform=?, target_audience=?, service_includes=?, requirements=?, delivery_time=?, revisions=?, notes=?, image_url=? WHERE product_id=?");
        $stmt->execute([$duration, $platform, $target_audience, $service_includes, $requirements, $delivery_time, $revisions, $notes, $image_url, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO product_details (product_id,duration,platform,target_audience,service_includes,requirements,delivery_time,revisions,notes,image_url) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$id,$duration, $platform, $target_audience, $service_includes, $requirements, $delivery_time, $revisions, $notes, $image_url]);
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6 mx-auto max-w-3xl">
<h2 class="text-2xl font-semibold mb-4">Edit Product</h2>

<form method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-2xl space-y-4">
    <div>
        <label class="font-medium">Category</label>
        <select name="category_id" class="w-full border p-2 rounded" required>
            <?php foreach($categories as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id']==$product['category_id']?'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="font-medium">Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded" value="<?= htmlspecialchars($product['title']) ?>" required>
    </div>

    <div>
        <label class="font-medium">Price</label>
        <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" value="<?= htmlspecialchars($product['price']) ?>" required>
    </div>

    <div>
        <label class="font-medium">Description</label>
        <textarea name="description" class="w-full border p-2 rounded"><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <h3 class="text-xl font-semibold mt-4">Product Details</h3>

    <div>
        <label class="font-medium">Duration</label>
        <input type="text" name="duration" class="w-full border p-2 rounded" value="<?= htmlspecialchars($details['duration'] ?? '') ?>">
    </div>

    <div>
        <label class="font-medium">Platform</label>
        <input type="text" name="platform" class="w-full border p-2 rounded" value="<?= htmlspecialchars($details['platform'] ?? '') ?>">
    </div>

    <div>
        <label class="font-medium">Target Audience</label>
        <input type="text" name="target_audience" class="w-full border p-2 rounded" value="<?= htmlspecialchars($details['target_audience'] ?? '') ?>">
    </div>

    <div>
        <label class="font-medium">Service Includes</label>
        <textarea name="service_includes" class="w-full border p-2 rounded"><?= htmlspecialchars($details['service_includes'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="font-medium">Requirements</label>
        <textarea name="requirements" class="w-full border p-2 rounded"><?= htmlspecialchars($details['requirements'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="font-medium">Delivery Time</label>
        <input type="text" name="delivery_time" class="w-full border p-2 rounded" value="<?= htmlspecialchars($details['delivery_time'] ?? '') ?>">
    </div>

    <div>
        <label class="font-medium">Revisions</label>
        <input type="number" name="revisions" class="w-full border p-2 rounded" value="<?= htmlspecialchars($details['revisions'] ?? 0) ?>">
    </div>

    <div>
        <label class="font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded"><?= htmlspecialchars($details['notes'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="font-medium">Product Image</label>
        <?php if (!empty($details['image_url'])): ?>
            <img src="/../../public/assets/images/products/<?= htmlspecialchars($details['image_url']) ?>"
                 alt="Current Image" class="w-48 h-48 object-cover mb-2 border rounded">
        <?php endif; ?>
        <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image.</p>
    </div>


    <div class="flex justify-end gap-2">
        <a href="index.php" class="px-4 py-2 border rounded">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Update</button>
    </div>
</form>
</body>
</html>
