<?php
session_start();
$pdo = require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

    <div class="text-center">
      <h2 class="text-2xl font-bold mb-2">Log In</h2>
      <p class="text-gray-500 mb-6">Welcome back! Please login to continue.</p>
    </div>

      <?php if (isset($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <input name="email" type="email" required placeholder="Email"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <input name="password" type="password" required placeholder="Password"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <button type="submit"
                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition">
          Sign In
        </button>
      </form>

      <p class="text-center text-gray-500 mt-6">
        Don't have an account?
        <a href="signup.php" class="text-black font-semibold">Sign Up</a>
      </p>

    </div>
  </div>

</body>
</html>
