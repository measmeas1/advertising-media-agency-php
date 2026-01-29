<?php
// Assuming you already have session.php included and admin info in $_SESSION
$adminName = $_SESSION['name'] ?? 'Admin';
?>
<header class="flex justify-between items-center mb-6 bg-white shadow px-6 py-4 rounded">
  <span class="text-gray-700 font-bold">Hello, <?= htmlspecialchars($_SESSION['name'] ?? 'Admin') ?></span>
  <div class="flex items-center gap-4">
    <a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
      Logout
    </a>
  </div>
</header>