<?php
// ===== HANDLE FORM SUBMIT =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // GET DATA
    $name = $_POST['name'] ?? '';
    $code = $_POST['code'] ?? '';
    $qty  = $_POST['qty'] ?? 0;

    // 👉 HERE YOU CAN INSERT TO DATABASE
    // example:
    // include '../config/database.php';
    // $stmt = $conn->prepare("INSERT INTO categories (name, code, qty) VALUES (?, ?, ?)");
    // $stmt->execute([$name, $code, $qty]);

    // ✅ REDIRECT TO VIEW CATEGORY
    header("Location: index.php");
    exit;
}
?>

<!-- ===== UI FORM ===== -->
<h3 class="text-xl font-semibold mb-4">Add New Category</h3>

<form action="create.php" method="post">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Name</label>
        <input type="text" name="name"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Code</label>
        <input type="text" name="code"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div>

   <div class="mb-4">
        <label class="block mb-1 font-medium">Category</label>
        <input type="text" name="code"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div> 

    <div class="mb-4">
        <label class="block mb-1 font-medium">Quantity</label>
        <input type="text" name="code"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">date</label>
        <input type="number" name="qty"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div>

    <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal()"
                class="px-4 py-2 border rounded hover:bg-gray-100">
            Cancel
        </button>
        <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Save
        </button>
    </div>
</form> 




