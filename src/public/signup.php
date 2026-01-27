<?php
$pdo = require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

    <div class="text-center">
      <h2 class="text-2xl font-bold mb-2">Sign Up</h2>
      <p class="text-gray-500 mb-6">Create your account to book advertising services.</p>
    </div>

      <form method="POST" class="space-y-4">
        <input name="name" required placeholder="Full Name"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <input name="email" type="email" required placeholder="Email"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <input name="password" type="password" required placeholder="Password"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <button type="submit"
                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition">
          Sign Up
        </button>
      </form>

      <p class="text-center text-gray-500 mt-6">
        Already have an account?
        <a href="login.php" class="text-black font-semibold">Sign In</a>
      </p>

    </div>
  </div>

</body>
</html>