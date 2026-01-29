<!-- ===== UI FORM ===== -->
<h3 class="text-xl font-semibold mb-4">Add New Category</h3>

<form method="POST" action="store.php">
    <div class="mb-4">
        <label class="block mb-1 font-medium">Name</label>
        <input type="text"
               name="name"
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400"
               required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Status</label>
        <select name="status"
                class="p-2 border rounded w-full"
                required>
            <option value="">Select Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <div class="flex justify-end space-x-2">
        <button type="button"
                onclick="closeModal()"
                class="px-4 py-2 border rounded hover:bg-gray-100">
            Cancel
        </button>

        <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Save
        </button>
    </div>
</form>
