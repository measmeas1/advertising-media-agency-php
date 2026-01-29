<?php
// Assuming you already have session.php included and admin info in $_SESSION
$adminName = $_SESSION['name'] ?? 'Admin';
?>
<header class="flex justify-between items-center mb-6 bg-white shadow px-6 py-4 rounded">
  <span class="text-gray-700 font-bold">Hello, <?= htmlspecialchars($_SESSION['name'] ?? 'Admin') ?></span>
  <div class="flex items-center gap-4">
    <button onclick="openLogoutModal()"
      class="bg-red-500 text-white font-bold px-4 py-2 rounded-lg hover:bg-red-600 transition">
      Logout
    </button>
  </div>
</header>

<div id="logoutModal"
  class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

  <h2 class="text-lg font-semibold mb-2">Confirm Logout</h2>
  <p class="text-gray-500 mb-6">Are you sure you want to logout?</p>

  <div class="bg-white rounded-xl p-6 w-full max-w-sm">
    <div class="flex justify-end gap-3">
      <button onclick="closeLogoutModal()"
        class="px-4 py-2 border rounded-lg hover:bg-gray-100">
        Cancel
      </button>
        
      <form action="logout.php" method="POST">
        <button class="px-4 py-2 bg-red-500 text-white rounded-lg">
          Logout
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
    document.getElementById('logoutModal').classList.add('flex');
  }
  function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
  }
</script>