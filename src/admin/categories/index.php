<?php
    include('../session.php');
    $pdo = require_once __DIR__ . '/../../config/db.php';

    // ADD CATEGORY
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_name'], $_POST['add_status'])) {
        $stmt = $pdo->prepare("INSERT INTO categories (name, status) VALUES (?, ?)");
        $stmt->execute([$_POST['add_name'], $_POST['add_status']]);
        header("Location: index.php");
        exit;
    }

    // EDIT CATEGORY
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'], $_POST['edit_name'], $_POST['edit_status'])) {
        $stmt = $pdo->prepare("UPDATE categories SET name = ?, status = ? WHERE id = ?");
        $stmt->execute([$_POST['edit_name'], $_POST['edit_status'], $_POST['edit_id']]);
        header("Location: index.php");
        exit;
    }

    // DELETE CATEGORY
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category_id'])) {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$_POST['delete_category_id']]);
        header("Location: index.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM categories ORDER BY id ASC");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $currentPage = 'categories';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-blue-900 text-white p-5">
            <div class="flex justify-left items-center mb-6">
                <img src="../../assets/images/logo.png" class="w-10 h-10">
                <h1 class="text-2xl font-bold">Advertising</h1>
            </div>
            <nav class="space-y-4">
                <a href="../dashboard/index.php"
                   class="block p-3 rounded <?= $currentPage=='dashboard'?'bg-blue-800':'hover:bg-blue-800' ?>">
                    Dashboard
                </a>

                <a href="../customers/index.php" class="block p-3 rounded hover:bg-blue-800">Customers</a>
    
                <a href="../products/index.php"
                   class="block p-3 rounded <?= $currentPage=='products'?'bg-blue-800':'hover:bg-blue-800' ?>">
                    Products
                </a>
    
                <a href="index.php"
                   class="block p-3 rounded bg-blue-800">
                    Categories
                </a>
    
                <a href="../bookings/index.php"
                   class="block p-3 rounded <?= $currentPage=='bookings'?'bg-blue-800':'hover:bg-blue-800' ?>">
                    Bookings
                </a>
            </nav>
        </aside>
    
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            <?php include '../header.php'; ?>
            <div class="bg-white p-6 rounded shadow">
                <table class="w-full text-left border-collapse">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Categories</h2>
                        <button onclick="openModal()"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Add Category
                         </button>
                    </div>
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)): ?>
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">
                                    No categories found.
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php foreach ($categories as $category): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="p-2 border"><?= $category['id'] ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($category['name']) ?></td>
                                <td class="p-2 border">
                                    <span class="px-2 py-1 rounded text-sm
                                        <?= $category['status']=='active'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-gray-200 text-gray-700' ?>">
                                        <?= ucfirst($category['status']) ?>
                                    </span>
                                </td>
                        
                                <td class="p-2 border flex gap-2">
                                    <!-- EDIT -->
                                    <button
                                      onclick="openEditModal(
                                        <?= $category['id'] ?>,
                                        '<?= htmlspecialchars($category['name'], ENT_QUOTES) ?>',
                                        '<?= $category['status'] ?>'
                                      )"
                                      class="px-3 py-1 bg-yellow-600 text-white rounded"
                                    >
                                      Edit
                                    </button>

                                    <!-- DELETE -->
                                    <form method="POST"
                                          onsubmit="return confirm('Delete this category?');">
                                        <input type="hidden"
                                               name="delete_category_id"
                                               value="<?= $category['id'] ?>">
                                        <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
                        
    <!-- ADD CATEGORY MODAL -->
    <div id="addCategoryModal"
         class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                        
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <button onclick="closeModal()"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                &times;
            </button>
                        
            <?php include 'create.php'; ?>
        </div>
    </div>
                        
    <script>
    function openModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    function openEditModal(id, name, status) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_status').value = status;

        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    </script>
    <?php include 'edit.php'; ?>
</body>
</html>
