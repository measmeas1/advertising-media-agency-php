<!-- EDIT CATEGORY MODAL -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
        <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>
        <h3 class="text-xl font-semibold mb-4">Edit Category</h3>
        <form method="post">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="edit_name" id="edit_name" class="w-full border rounded px-3 py-2" required>
            </div>
            <select name="edit_status" id="edit_status" class="p-2 border rounded w-full mb-4" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
